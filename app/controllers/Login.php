
<?php
class Login extends Controller {
		public function index(array $data = []): void {
				$this->view('login/index', $data);
		}

		public function verify(): void {
				if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
						$this->redirect('/login');
				}

				$u     = trim($_POST['username'] ?? '');
				$pw    = $_POST['password']      ?? '';
				$userM = $this->model('User');


				$lastFail = $userM->getLastFailed($u);
				if ($lastFail && time() < strtotime($lastFail) + 60) {
						$wait = (strtotime($lastFail) + 60) - time();
						$this->view('login/index', [
								'error'    => "Account locked. Try again in {$wait}s.",
								'username' => $u,
						]);
						return;
				}

				$user = $userM->findByUsername($u);
				if (! $user || ! password_verify($pw, $user['password_hash'])) {
						$userM->recordLoginAttempt($u, 'failure');
						$this->view('login/index', [
								'error'    => 'Invalid credentials.',
								'username' => $u,
						]);
						return;
				}


				$userM->recordLoginAttempt($u, 'success');
				$userM->incrementLoginCount((int)$user['id']);

				$_SESSION['auth']       = true;
				$_SESSION['user_id']    = $user['id'];
				$_SESSION['username']   = $user['username'];
				$_SESSION['is_admin']   = (bool)$user['is_admin'];

				$this->redirect('/reminders');
		}

		public function logout(): void {
				session_destroy();
				$this->redirect('/login');
		}
}