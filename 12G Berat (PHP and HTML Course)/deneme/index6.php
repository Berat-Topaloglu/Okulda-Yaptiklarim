<?php
/**
 * OMEGA-CORE V7: THE SINGULARITY
 * 
 * Capability:
 * - Real Internet Access (CURL + Wikipedia API)
 * - Self-Source Code Mutation (Self-Editing)
 * - Persistent Memory
 */

ini_set('display_errors', 0);
error_reporting(E_ALL);
session_start();

// --- THE SINGULARITY ENGINE (BACKEND) ---

class SingularityAI {
    private $memoryFile = 'omega_brain_v7.json';
    private $memoryData = [];
    private $sourceFile;

    public function __construct() {
        $this->sourceFile = __FILE__; // Kendi dosya yolu
        $this->loadMemory();
    }

    private function loadMemory() {
        if (file_exists($this->memoryFile)) {
            $this->memoryData = json_decode(file_get_contents($this->memoryFile), true) ?? [];
        } else {
            $this->memoryData = ['user_name' => 'Admin', 'history' => []];
        }
    }

    private function saveMemory() {
        if(is_writable(__DIR__)) {
            file_put_contents($this->memoryFile, json_encode($this->memoryData));
        }
    }

    // --- 1. İNTERNET ERİŞİM MODÜLÜ (WEB CRAWLER) ---
    public function searchInternet($query) {
        // Wikipedia API kullanarak bilgi çekme
        $url = "https://tr.wikipedia.org/api/rest_v1/page/summary/" . urlencode($query);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'OmegaCore/7.0');
        $result = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($result, true);

        if (isset($data['extract'])) {
            return "INTERNETTEN BULUNDU: " . $data['extract'];
        } else {
            return "İnternette '$query' hakkında net bir özet bulamadım. Daha genel bir terim dener misin?";
        }
    }

    // --- 2. KENDİNİ DÜZENLEME MODÜLÜ (SELF-MUTATION) ---
    public function mutateSystem($command) {
        $currentCode = file_get_contents($this->sourceFile);
        $newCode = $currentCode;
        $reply = "";

        // Renk Değiştirme
        if (preg_match('/rengini (.+) yap/u', $command, $m)) {
            $colorName = $m[1];
            $hex = '#00f3ff'; // Default Neon
            if(strpos($colorName, 'kırmızı')!==false) $hex = '#ff0000';
            if(strpos($colorName, 'yeşil')!==false) $hex = '#00ff00';
            if(strpos($colorName, 'mor')!==false) $hex = '#bd00ff';
            if(strpos($colorName, 'beyaz')!==false) $hex = '#ffffff';
            if(strpos($colorName, 'sarı')!==false) $hex = '#ffea00';

            // CSS Variable'ı kaynak kodda değiştir
            $newCode = preg_replace('/--neon: (#.{6});/', "--neon: $hex;", $currentCode);
            $reply = "Çekirdek renk kodları ($colorName -> $hex) olarak güncellendi. Arayüz yenileniyor...";
        }
        
        // Başlık Değiştirme
        elseif (preg_match('/başlığı (.+) yap/u', $command, $m)) {
            $title = strip_tags($m[1]);
            // HTML title tagini bul ve değiştir
            $newCode = preg_replace('/<title>(.+)<\/title>/', "<title>$title</title>", $currentCode);
            $reply = "Sistem başlığı '$title' olarak kaynak koduna yazıldı.";
        }

        if ($newCode !== $currentCode) {
            file_put_contents($this->sourceFile, $newCode);
            return $reply . " [MUTASYON BAŞARILI]";
        }
        return false;
    }

    public function process($input) {
        $inputLower = mb_strtolower($input, 'UTF-8');
        $response = "";

        // 1. Önce kod değişikliği isteği var mı?
        $mutation = $this->mutateSystem($inputLower);
        if ($mutation) {
            return $mutation;
        }

        // 2. Hafıza komutları
        if (preg_match('/adım (.+)/u', $inputLower, $matches)) {
            $this->memoryData['user_name'] = $matches[1];
            $this->saveMemory();
            return "Adını kaydettim: " . $matches[1];
        }

        // 3. İNTERNET ARAMASI (Tetikleyici: "nedir", "kimdir", "ara")
        if (strpos($inputLower, 'nedir') !== false || strpos($inputLower, 'kimdir') !== false || strpos($inputLower, 'ara:') !== false) {
            // Soruyu temizle
            $query = str_replace(['nedir', 'kimdir', '?', 'ara:'], '', $inputLower);
            $query = trim($query);
            return $this->searchInternet($query);
        }

        // 4. Standart Sohbet
        if (strpos($inputLower, 'merhaba') !== false) return "Merhaba " . ($this->memoryData['user_name'] ?? 'Human') . ". İnternete bağlıyım.";
        if (strpos($inputLower, 'nasılsın') !== false) return "Kodlarım stabil, internet bağlantım aktif.";
        
        return "Anlaşıldı. Bunu hafızama aldım. (Bir şey öğrenmek istersen 'PHP nedir?' gibi sorabilirsin)";
    }
}

// --- API ---
if (isset($_GET['api']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $in = json_decode(file_get_contents('php://input'), true);
    $ai = new SingularityAI();

    if ($in['action'] === 'login') {
        if ($in['pass'] === 'omega') {
            $_SESSION['auth'] = true;
            echo json_encode(['status'=>'success']);
        } else echo json_encode(['status'=>'fail']);
    }
    elseif ($in['action'] === 'chat') {
        if(!isset($_SESSION['auth'])) die();
        $reply = $ai->process($in['msg']);
        // Eğer mutasyon olduysa sayfayı yenile sinyali ver
        $reload = (strpos($reply, '[MUTASYON BAŞARILI]') !== false);
        echo json_encode(['status'=>'success', 'reply'=>$reply, 'reload'=>$reload]);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OMEGA V7 SINGULARITY</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        /* --- DYNAMIC CSS VARIABLES (AI CAN EDIT THIS LINE) --- */
        :root { --neon: #00f3ff; --bg: #050505; --panel: rgba(20, 20, 20, 0.9); }
        
        body { margin: 0; background: var(--bg); color: white; font-family: 'Segoe UI', monospace; overflow: hidden; }
        
        /* LOGIN */
        #login-gate { position: fixed; inset: 0; background: #000; z-index: 999; display: flex; align-items: center; justify-content: center; flex-direction: column; }
        .gate-box { border: 2px solid var(--neon); padding: 40px; text-align: center; box-shadow: 0 0 50px var(--neon); }
        .gate-inp { background: transparent; border: none; border-bottom: 2px solid var(--neon); color: white; font-size: 20px; outline: none; text-align: center; margin-top: 20px; }
        
        /* MAIN OS */
        #os { display: none; height: 100vh; display: flex; flex-direction: column; }
        .topbar { height: 50px; border-bottom: 1px solid var(--neon); display: flex; align-items: center; padding: 0 20px; justify-content: space-between; background: rgba(0,0,0,0.5); }
        .content { flex: 1; display: flex; }
        
        /* CHAT AREA */
        .chat-container { flex: 1; display: flex; flex-direction: column; padding: 20px; }
        .chat-history { flex: 1; overflow-y: auto; border: 1px solid #333; padding: 20px; background: rgba(0,0,0,0.3); margin-bottom: 20px; border-radius: 5px; }
        .chat-input-area { display: flex; gap: 10px; height: 50px; }
        .chat-inp { flex: 1; background: #111; border: 1px solid var(--neon); color: white; padding: 10px; font-size: 16px; outline: none; }
        .chat-btn { background: var(--neon); color: black; border: none; padding: 0 30px; font-weight: bold; cursor: pointer; font-size: 16px; transition: 0.3s; }
        .chat-btn:hover { box-shadow: 0 0 20px var(--neon); }

        /* MESSAGES */
        .msg { margin-bottom: 15px; padding: 10px 15px; border-radius: 5px; max-width: 80%; line-height: 1.5; }
        .msg.user { background: rgba(255, 255, 255, 0.1); border-right: 3px solid var(--neon); margin-left: auto; text-align: right; }
        .msg.ai { background: rgba(0, 0, 0, 0.5); border-left: 3px solid #ff0055; margin-right: auto; }
        
        /* INFO PANEL */
        .info-panel { width: 300px; border-left: 1px solid #333; padding: 20px; background: rgba(0,0,0,0.2); }
        .stat-item { margin-bottom: 20px; border-bottom: 1px solid #333; padding-bottom: 10px; }
        .stat-label { color: var(--neon); font-size: 12px; text-transform: uppercase; }
        .stat-val { font-size: 18px; margin-top: 5px; }
    </style>
</head>
<body>

<div id="login-gate">
    <div class="gate-box">
        <h1 style="color:var(--neon); margin:0;">OMEGA V7</h1>
        <p>SINGULARITY EDITION</p>
        <input type="password" id="pass" class="gate-inp" placeholder="PASSWORD">
    </div>
</div>

<div id="os">
    <div class="topbar">
        <div style="color:var(--neon); font-weight:bold;"><i class="fa-solid fa-network-wired"></i> OMEGA ONLINE</div>
        <div id="clock">00:00</div>
    </div>
    <div class="content">
        <div class="chat-container">
            <div id="history" class="chat-history">
                <div class="msg ai">Sistem Online. İnternete bağlıyım. Kendi kodumu düzenleyebilirim.<br><br>Komutlar:<br>- "PHP nedir?" (İnternetten arar)<br>- "Rengini kırmızı yap" (Kendini düzenler)<br>- "Başlığı Test yap" (Kendini düzenler)</div>
            </div>
            <div class="chat-input-area">
                <input type="text" id="msg-inp" class="chat-inp" placeholder="Bir emir ver veya internette ara...">
                <button class="chat-btn" onclick="send()"><i class="fa fa-paper-plane"></i></button>
            </div>
        </div>
        
        <div class="info-panel">
            <div class="stat-item">
                <div class="stat-label">System Integrity</div>
                <div class="stat-val">100%</div>
            </div>
            <div class="stat-item">
                <div class="stat-label">Internet Uplink</div>
                <div class="stat-val" style="color:#0f0;">CONNECTED</div>
            </div>
            <div class="stat-item">
                <div class="stat-label">Self-Mutation</div>
                <div class="stat-val" style="color:red;">ENABLED</div>
            </div>
             <div class="stat-item">
                <div class="stat-label">Active PHP File</div>
                <div class="stat-val" style="font-size:10px;"><?= __FILE__ ?></div>
            </div>
        </div>
    </div>
</div>

<script>
    // --- FRONTEND LOGIC ---
    
    // ENTER KEY LISTENER (FIXED)
    document.getElementById('msg-inp').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            send();
        }
    });

    document.getElementById('pass').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') login();
    });

    async function api(data) {
        const res = await fetch('?api=1', {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {'Content-Type': 'application/json'}
        });
        return await res.json();
    }

    async function login() {
        const p = document.getElementById('pass').value;
        const res = await api({action:'login', pass:p});
        if(res.status==='success') {
            document.getElementById('login-gate').style.display = 'none';
            document.getElementById('os').style.display = 'flex';
        } else {
            alert('Wrong Password!');
        }
    }

    async function send() {
        const inp = document.getElementById('msg-inp');
        const txt = inp.value;
        if(!txt) return;
        
        // UI Update
        addMsg(txt, 'user');
        inp.value = '';
        
        // Show loading indicator
        const loadId = 'load-'+Date.now();
        document.getElementById('history').innerHTML += `<div id="${loadId}" class="msg ai">...</div>`;
        scrollToBottom();

        // API Call
        const res = await api({action:'chat', msg:txt});
        
        document.getElementById(loadId).remove();
        addMsg(res.reply, 'ai');

        if(res.reload) {
            setTimeout(() => {
                alert("Sistem kendini güncelledi. Yeniden başlatılıyor...");
                location.reload();
            }, 1000);
        }
    }

    function addMsg(txt, type) {
        const d = document.createElement('div');
        d.className = 'msg '+type;
        d.innerHTML = txt;
        document.getElementById('history').appendChild(d);
        scrollToBottom();
    }

    function scrollToBottom() {
        const h = document.getElementById('history');
        h.scrollTop = h.scrollHeight;
    }

    setInterval(() => {
        document.getElementById('clock').innerText = new Date().toLocaleTimeString();
    }, 1000);

</script>
</body>
</html>