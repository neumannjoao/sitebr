<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Caminho para a pasta principal de documentos
    $mainDir = "/htdocs/TESTE/DOCUMENTOS/";

    // Diretório onde os arquivos serão armazenados, usando o código de ERC e a regional
    $dirName = $_POST['codigo_erc'] . $_POST['regional'];
    $uploadDir = $mainDir . $dirName . "/";

    // Verifica se a pasta principal de documentos existe, se não, cria-a
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Array com os nomes dos arquivos a serem enviados e seus respectivos campos
    $fileNames = array(
        "pgfn" => "Certidão de Débitos PGFN",
        "issqn" => "Certidão de Quitação do Imposto Sobre Serviços",
        "fgts" => "Certidão de Regularidade do Empregador perante o FGTS",
        "antecedentes" => "Certidão de Antecedentes Criminais",
        "protestos" => "Certidão de Protestos",
        "contratosocial" => "Contrato Social"
    );

    // Percorre os arquivos enviados
    foreach ($_FILES as $inputName => $file) {
        // Verifica se o arquivo foi enviado sem erros
        if ($file['error'] == UPLOAD_ERR_OK) {
            // Define o nome do arquivo
            $fileName = $fileNames[$inputName] . ".pdf";
            // Move o arquivo para o diretório de uploads
            move_uploaded_file($file['tmp_name'], $uploadDir . $fileName);
        }
    }
    
    // Exibe mensagem de sucesso
    echo "Documentos enviados com sucesso!";
} else {
    // Se o método de requisição não for POST, redireciona para a página inicial
    header("Location: index.html");
    exit;
}
?>
