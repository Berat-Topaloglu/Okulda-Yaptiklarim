<?php
/**
 * TEK DOSYALI PHP KOMPLEKS YÖNETİM SİSTEMİ
 * Özellikler: OOP Yapı, Session Yönetimi, Çoklu Modül, Bootstrap 5 Arayüzü
 */

session_start();

// --- 1. UYGULAMA MANTIĞI VE SINIFLAR (BACKEND) ---

class AppManager {
    private $currentPage;
    private $alerts = [];

    public function __construct() {
        $this->currentPage = $_GET['page'] ?? 'dashboard';
        $this->handlePostRequests();
    }

    // POST İsteklerini Yakala ve İşle
    private function handlePostRequests() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // Görev Ekleme Modülü
            if (isset($_POST['action']) && $_POST['action'] === 'add_task') {
                $task = trim($_POST['task']);
                if (!empty($task)) {
                    $_SESSION['tasks'][] = [
                        'id' => uniqid(),
                        'content' => htmlspecialchars($task),
                        'date' => date('H:i:s')
                    ];
                    $this->setAlert('Görev başarıyla eklendi!', 'success');
                }
            }

            // Görev Silme Modülü
            if (isset($_POST['action']) && $_POST['action'] === 'delete_task') {
                $idToDelete = $_POST['task_id'];
                foreach ($_SESSION['tasks'] as $key => $task) {
                    if ($task['id'] === $idToDelete) {
                        unset($_SESSION['tasks'][$key]);
                        $this->setAlert('Görev silindi.', 'warning');
                    }
                }
            }

            // Hash Dönüştürme Modülü
            if (isset($_POST['action']) && $_POST['action'] === 'convert_hash') {
                $text = $_POST['text_to_hash'];
                $_SESSION['last_hash_result'] = [
                    'original' => $text,
                    'md5' => md5($text),
                    'sha1' => sha1($text),
                    'base64' => base64_encode($text)
                ];
                $this->setAlert('Şifreleme tamamlandı.', 'info');
            }
            
            // Sayfa yenilendiğinde form tekrar gönderilmesin diye yönlendirme (PRG Pattern)
            // Ancak tek dosya mantığı bozulmasın diye burada bırakıyoruz,
            // gerçek projede header("Location: ...") kullanılır.
        }
    }

    private function setAlert($msg, $type) {
        $this->alerts[] = ['msg' => $msg, 'type' => $type];
    }

    public function getAlerts() {
        return $this->alerts;
    }

    public function getPage() {
        return $this->currentPage;
    }
}

// Uygulamayı Başlat
$app = new AppManager();
$page = $app->getPage();

// Görevler için Session başlatma kontrolü
if (!isset($_SESSION['tasks'])) { $_SESSION['tasks'] = []; }

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tek Dosya PHP Sistem</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { min-height: 100vh; background: #212529; color: white; }
        .sidebar a { color: #adb5bd; text-decoration: none; padding: 10px 15px; display: block; border-radius: 5px; transition: 0.3s; }
        .sidebar a:hover, .sidebar a.active { background: #0d6efd; color: white; }
        .card { box-shadow: 0 4px 6px rgba(0,0,0,0.1); border: none; margin-bottom: 20px; }
        .alert-area { position: fixed; top: 20px; right: 20px; z-index: 9999; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- --- 2. SIDEBAR (NAVİGASYON) --- -->
        <div class="col-md-3 col-lg-2 sidebar p-3">
            <h3 class="text-center mb-4"><i class="fa-solid fa-code"></i> PHP-SYS</h3>
            <hr>
            <nav class="nav flex-column">
                <a href="?page=dashboard" class="<?= $page=='dashboard'?'active':'' ?>"><i class="fa-solid fa-gauge me-2"></i> Panel Özeti</a>
                <a href="?page=tasks" class="<?= $page=='tasks'?'active':'' ?>"><i class="fa-solid fa-list-check me-2"></i> Görev Yöneticisi</a>
                <a href="?page=tools" class="<?= $page=='tools'?'active':'' ?>"><i class="fa-solid fa-toolbox me-2"></i> Hash & Çevirici</a>
                <a href="?page=server" class="<?= $page=='server'?'active':'' ?>"><i class="fa-solid fa-server me-2"></i> Sistem Bilgisi</a>
                <hr>
                <a href="?page=logout" class="text-danger"><i class="fa-solid fa-power-off me-2"></i> Oturumu Sıfırla</a>
            </nav>
        </div>

        <!-- --- 3. İÇERİK ALANI --- -->
        <div class="col-md-9 col-lg-10 p-4">
            
            <!-- Uyarılar -->
            <div class="alert-area">
                <?php foreach($app->getAlerts() as $alert): ?>
                    <div class="alert alert-<?= $alert['type'] ?> alert-dismissible fade show" role="alert">
                        <?= $alert['msg'] ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Sayfa Yönlendirme (Routing) Switch -->
            <?php switch($page): 
                case 'dashboard': ?>
                    <!-- DASHBOARD SAYFASI -->
                    <h2 class="mb-4">Genel Bakış</h2>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card bg-primary text-white h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Toplam Görev</h5>
                                    <p class="display-4"><?= count($_SESSION['tasks']) ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-white h-100">
                                <div class="card-body">
                                    <h5 class="card-title">PHP Sürümü</h5>
                                    <p class="display-6"><?= phpversion() ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-warning text-dark h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Zaman</h5>
                                    <p class="display-6" id="clock"><?= date('H:i') ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-header">Hoşgeldiniz</div>
                        <div class="card-body">
                            <p>Bu sistem tek bir <code>.php</code> dosyası içinde çalışmaktadır. Sol taraftaki menüden modüller arası geçiş yapabilirsiniz. Veriler PHP Session (Oturum) üzerinde tutulur.</p>
                        </div>
                    </div>
                <?php break; ?>

                <?php case 'tasks': ?>
                    <!-- GÖREV YÖNETİCİSİ -->
                    <h2 class="mb-4">Görev Yöneticisi</h2>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-dark text-white">Yeni Ekle</div>
                                <div class="card-body">
                                    <form method="POST">
                                        <input type="hidden" name="action" value="add_task">
                                        <div class="mb-3">
                                            <label>Yapılacak İş</label>
                                            <input type="text" name="task" class="form-control" required placeholder="Örn: Sunucu yedeklemesi...">
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Ekle</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">Liste</div>
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush">
                                        <?php if(empty($_SESSION['tasks'])): ?>
                                            <li class="list-group-item text-center text-muted">Henüz görev yok.</li>
                                        <?php else: ?>
                                            <?php foreach(array_reverse($_SESSION['tasks']) as $task): ?>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <strong><?= $task['content'] ?></strong><br>
                                                        <small class="text-muted"><?= $task['date'] ?></small>
                                                    </div>
                                                    <form method="POST" style="margin:0;">
                                                        <input type="hidden" name="action" value="delete_task">
                                                        <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
                                                        <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php break; ?>

                <?php case 'tools': ?>
                    <!-- ARAÇLAR MODÜLÜ -->
                    <h2 class="mb-4">Geliştirici Araçları</h2>
                    <div class="card">
                        <div class="card-header">String Converter / Hasher</div>
                        <div class="card-body">
                            <form method="POST">
                                <input type="hidden" name="action" value="convert_hash">
                                <div class="input-group mb-3">
                                    <input type="text" name="text_to_hash" class="form-control" placeholder="Metin girin..." required>
                                    <button class="btn btn-outline-secondary" type="submit">Dönüştür</button>
                                </div>
                            </form>

                            <?php if(isset($_SESSION['last_hash_result'])): 
                                $res = $_SESSION['last_hash_result']; ?>
                                <div class="mt-4">
                                    <h6>Sonuçlar: "<?= htmlspecialchars($res['original']) ?>"</h6>
                                    <table class="table table-bordered">
                                        <tr><td width="150">MD5</td><td><code><?= $res['md5'] ?></code></td></tr>
                                        <tr><td>SHA1</td><td><code><?= $res['sha1'] ?></code></td></tr>
                                        <tr><td>Base64</td><td><code><?= $res['base64'] ?></code></td></tr>
                                    </table>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php break; ?>

                <?php case 'server': ?>
                    <!-- SUNUCU BİLGİLERİ -->
                    <h2 class="mb-4">Sistem Bilgileri</h2>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover card">
                            <thead class="table-dark">
                                <tr><th>Anahtar</th><th>Değer</th></tr>
                            </thead>
                            <tbody>
                                <tr><td>PHP Version</td><td><?= phpversion() ?></td></tr>
                                <tr><td>Sunucu Yazılımı</td><td><?= $_SERVER['SERVER_SOFTWARE'] ?></td></tr>
                                <tr><td>Sunucu IP</td><td><?= $_SERVER['SERVER_ADDR'] ?? 'Localhost' ?></td></tr>
                                <tr><td>İstemci IP</td><td><?= $_SERVER['REMOTE_ADDR'] ?></td></tr>
                                <tr><td>User Agent</td><td><?= $_SERVER['HTTP_USER_AGENT'] ?></td></tr>
                                <tr><td>Oturum ID</td><td><?= session_id() ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="alert alert-info">
                        <strong>Bilgi:</strong> Bu bilgiler <code>$_SERVER</code> süper globali kullanılarak çekilmiştir.
                    </div>
                <?php break; ?>
                
                <?php case 'logout':
                    session_destroy();
                    echo "<script>window.location.href='?page=dashboard';</script>";
                break; ?>

                <?php default: ?>
                    <div class="alert alert-danger">Sayfa bulunamadı.</div>
                <?php break; ?>
            <?php endswitch; ?>

        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Basit bir saat güncelleme scripti
    setInterval(() => {
        const d = new Date();
        const time = d.getHours() + ':' + (d.getMinutes()<10?'0':'') + d.getMinutes();
        if(document.getElementById('clock')) document.getElementById('clock').innerText = time;
    }, 1000);
</script>
</body>
</html>