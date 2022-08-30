<?php 

    $images = scandir(__DIR__ . '/imagens'); 
    $links = scandir(__DIR__);
    $url = 'https://' . $_SERVER['HTTP_HOST'] . '/';
    $regiao = 'São Paulo';
    $sitename = 'HD Visual';

    function retornaFoco(){
        $paginaAssunto = [
            'adesivos',
            'banner',
            'fachadas',
            'letras',
            'plotagem'
        ];
        foreach($paginaAssunto as $assunto){
            if(strpos($_SERVER['REQUEST_URI'], $assunto)){
                return $assunto;
            }
        }
    }

    function retornaLinks(){
        $pages = [''];
        $dir = scandir(__DIR__);
        foreach($dir as $files){
            if(strpos($files, retornaFoco()) === false){
                continue;
            }
            array_push($pages, $files);
        }  
        return $pages;      
    }
 
    $keywords = [
        retornaFoco(), ' ' . retornaFoco() . ' em '. $regiao, 
        ' Comunicações visuais',
    ];

    $description = '';

    $nome = ucwords(str_replace('-', ' ', retornaFoco()));

    $title = 'Serviços de '. $nome .' em ' . $regiao;

    $foco = retornaFoco();

    $PalavraGerada = $foco . ' em ' . $regiao;

    $footer = strstr(file_get_contents(__DIR__ . '/home'), '<footer');
 ?>
 <!DOCTYPE html>
 <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="<?php echo $url . 'imagens/favicon.ico'?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="index,follow">
        <meta name="rating" content="General">
        <meta name="author" content="Buscacliente">
        <meta name="description" content="<?php echo $description ?>">
        <meta property="og:region" content="Brasil">
        <meta property="og:type" content="article">
        <meta property="og:image" content="<?php echo $url . 'imagens/logo.png'?>">
        <meta property="og:url" content="<?php echo $url?>"> 
        <meta property="og:site_name" content="<?php echo $sitename?>">
        <meta property="og:description" content="<?php echo $description ?>">
        <meta property="og:title" content="<?php echo $title?>">
        <meta name="revisit-after" content="7 days">
        <title><?php echo $title?></title>
        <base href="<?php echo $url?>">
        <link rel="canonical" href="<?php echo substr($url, 0, strlen($url) - 1) . $_SERVER['REQUEST_URI']?>">
        <meta name="keywords" content="<?php echo implode(',', $keywords) ?>">
        <link rel="stylesheet" href="<?php echo $url ?>css/theme.css" >
        <link rel="stylesheet" href="<?php echo $url ?>css/main.css" >
    </head>
    <body>
    <header>
        <div>
            <a href="<?php echo $url?>">
                <img src="<?php echo $url . '/imagens/logo.png'?>" width="150" height="">
            </a>
        </div>
    </header>
    <main>
        <h1>
            <?php echo 'Galeria ' . $title; ?>
        </h1>
        <ul class="galeria">
            <?php
                foreach($images as $key=>$image) { 
                    if(strpos($image, $foco) === false) {
                        continue;
                    }?>
                        <li>      
                            <img class="thumb-galeria" src="<?php echo $url.'imagens/'.$image?>" alt="<?php echo $links[$key]?>" width="200" height="200">   
                            <a class="cotar button" href="<?php echo $url.str_replace('_', '/', retornaLinks()[$key])?>">
                                Cotar agora    
                            </a>
                        </li>
               <?php } ?> 
        </ul>         
        <?php 
            
                    $content = file_get_contents(__DIR__ . '/' . retornaLinks()[1]);
                    $inicial = strpos($content, '<article class="readMore"');
                    $end = strpos($content, '<div class="collum-subject"'); 
                    $articleCrop = substr($content, $inicial, $end);
                    $finalCrop = strpos($articleCrop, '</article>');
                    
                    $articleMostlyEnd = substr($articleCrop, 0, $finalCrop);
                    $article = str_replace('Clique na imagem para expandir', '', $articleMostlyEnd);

                    echo $article;
        
        ?>
    </main>
    <div id="modal-galeria" class="hide">
        <div id="modal-container">
            <button id="closeModal"> X </button>
            <img src="" id="modal-photo"> 
            <div class="footer-modal">
                <p>Faça já uma cotação e saiba mais sobre os serviços de <?php echo $PalavraGerada; ?></p>
                <a class="cotar" href="<?php echo $url . 'contato'?>">Cotar Agora</a>
            </div>
        </div>
    </div>
    <?php echo $footer;?>
    </body>
</html>
<style>
    *{ font-family: 'Segoe UI'; padding: 0; margin: 0; }
    header { box-shadow: none; }
    header div{ margin: 15px auto; display: flex; justify-content: center;  }
    footer { background: #181818; }
    h1 { text-align: center; font-size: 2em; color: #333; background: #ccc; padding: 25px;}
    li { list-style: none;}
    .galeria { display: flex; flex-wrap: wrap; justify-content: center; padding: 0; margin: 20px auto; width: 90%; }
    .galeria li { display: flex; flex-direction: column; margin: 20px; }
    .galeria li img {  width: 200px; height: 200px; object-fit: ; margin: 5px;
        border: 4px solid #fff;box-shadow: 0 0 3px #ccc; padding: 3px; object-fit: cover;}
    .galeria li img:hover { transition: 0.7s; opacity: 0.5; cursor: zoom-in; }
    .readMore { padding: 5%; margin: 0 auto; background: #ebebeb; width: 100% !important; }
    .readMore p { margin: 10px 0; line-height: 1.5; }
    .readMore h2 { font-size: 2.5em !important; margin-top: 10px !important;}
    .readMore img { width: 50%; }
    .readMore ul li { list-style: disc !important;}
    .cotar { margin-bottom: 2px; background: orange; border-radius: 3px; color: #000; width: 196px; text-align: center; padding: 5px; text-decoration: none; margin: 2px auto;}
</style>
<script>

</script>
