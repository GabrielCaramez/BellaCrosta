<?php
// Função para verificar se o Flask está rodando
function isFlaskRunning() {
    $connection = @fsockopen('127.0.0.1', 5000, $errno, $errstr, 1);
    if ($connection) {
        fclose($connection);
        return true;
    }
    return false;
}

// Função para iniciar o servidor Flask
function startFlaskServer() {
    $pythonPath = 'python'; // ou 'python3' dependendo do sistema
    $scriptPath = __DIR__ . '/app.py';
    
    // Verifica se o arquivo app.py existe
    if (!file_exists($scriptPath)) {
        return false;
    }
    
    // Comando para iniciar o Flask em background
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        // Windows
        $command = "start /B $pythonPath \"$scriptPath\" > nul 2>&1";
        pclose(popen($command, 'r'));
    } else {
        // Linux/Mac
        $command = "$pythonPath \"$scriptPath\" > /dev/null 2>&1 &";
        exec($command);
    }
    
    return true;
}

// Verifica se o Flask está rodando
if (!isFlaskRunning()) {
    // Tenta iniciar o servidor Flask
    if (startFlaskServer()) {
        // Aguarda alguns segundos para o servidor iniciar
        $maxTries = 10;
        $tries = 0;
        
        while ($tries < $maxTries && !isFlaskRunning()) {
            sleep(1);
            $tries++;
        }
        
        if (isFlaskRunning()) {
            // Servidor iniciado com sucesso, redireciona
            header("Location: http://127.0.0.1:5000/");
            exit;
        } else {
            // Falha ao iniciar o servidor
            echo "
            <div style='
                background: linear-gradient(90deg, #ffb347 60%, #ff4e50 100%);
                color: #fff;
                border: 2px solid #ff4e50;
                border-radius: 10px;
                max-width: 500px;
                margin: 60px auto;
                padding: 25px 18px;
                font-family: Arial, sans-serif;
                font-size: 1.1em;
                text-align: center;
                box-shadow: 0 4px 16px rgba(255, 78, 80, 0.15);
            '>
                <h3 style='margin-top: 0; color: #fff;'>Erro ao iniciar o servidor de email</h3>
                <p>Não foi possível iniciar automaticamente o servidor Flask.</p>
                <p><strong>Soluções:</strong></p>
                <ul style='text-align: left; margin: 15px 0;'>
                    <li>Verifique se o Python está instalado</li>
                    <li>Execute manualmente: <code style='background: rgba(255,255,255,0.2); padding: 2px 6px; border-radius: 3px;'>python gmail/app.py</code></li>
                    <li>Instale as dependências: <code style='background: rgba(255,255,255,0.2); padding: 2px 6px; border-radius: 3px;'>pip install flask</code></li>
                </ul>
                <a href='javascript:history.back()' style='
                    background: #fff;
                    color: #ff4e50;
                    text-decoration: none;
                    padding: 8px 16px;
                    border-radius: 5px;
                    font-weight: bold;
                    display: inline-block;
                    margin-top: 10px;
                '>Voltar</a>
            </div>";
        }
    } else {
        echo "
        <div style='
            background: linear-gradient(90deg, #ffb347 60%, #ff4e50 100%);
            color: #fff;
            border: 2px solid #ff4e50;
            border-radius: 10px;
            max-width: 500px;
            margin: 60px auto;
            padding: 25px 18px;
            font-family: Arial, sans-serif;
            font-size: 1.1em;
            text-align: center;
            box-shadow: 0 4px 16px rgba(255, 78, 80, 0.15);
        '>
            <h3 style='margin-top: 0; color: #fff;'>Arquivo não encontrado</h3>
            <p>O arquivo <code>app.py</code> não foi encontrado no diretório gmail/</p>
            <a href='javascript:history.back()' style='
                background: #fff;
                color: #ff4e50;
                text-decoration: none;
                padding: 8px 16px;
                border-radius: 5px;
                font-weight: bold;
                display: inline-block;
                margin-top: 10px;
            '>Voltar</a>
        </div>";
    }
} else {
    // Flask já está rodando, redireciona diretamente
    header("Location: http://127.0.0.1:5000/");
    exit;
}
?>