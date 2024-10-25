<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/biblioteca/type.css">
    <title>Document</title>
    
</head>
<body background="../../assets/img/rio.jpg">
<nav>
    <ul class="menu">
        <li><a href="#">HOME</a></li> 
        {{-- <li><a href="#">SOBRE</a> --}}
        </li>
        {{-- <li><a href="album.php">ÁLBUM</a>
        </li> --}}
        <li><a href="#">CONTATO</a>
            <ul><a href="https://www.instagram.com/vitor_filmes?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==">INSTAGRAM</a></ul>
        </li>
        <li><a href="#">SERVIÇOS</a>
            <ul>
                <li><a href="cliente/serviço.php">CONTRATAR SERVIÇO</a></li>
            </ul>
        </li>
        <li><a href="{{ route('adm.login') }}">PAINEL DE CONTROLE</a>
        <li class="logout">
            <div class="card">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <button type="button" class="submit" id="sair">SAIR</button>                
            </div>
        </li>
    </ul>
</nav>
<style>
    *{
        user-select: none;
    }
    .compra{
        left: 20px;
        align-items: center;
        justify-content: center;
        display: flex;
        /* gap: 15px; */
        padding: 10px;
    }
    #boton{
        background-color: rgb(243, 0, 0);
        color: rgb(255, 255, 255);
        border: 5px;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
        white-space: nowrap;
        font-size: 14px;
        width: 150px;
        height: 20px;
        left: 20px;
        align-items: center;
        justify-content: center;
        display: flex;

    }
    #boton:hover{
        transform: scale(1.3);
    }
</style>
<div class="container">
    <h1 class="heading">BIBLIOTECA DE FOTOS</h1>
    <br><br>

    <div class="container-image" >
        @foreach ($imagens as $imagem)
            <div style="background-image: url('data:image/jpeg;base64,{{ $imagem->imagem }}'); background-size: cover; background-position: center; width: auto; height: 300px; display: flex; align-items: center; justify-content: flex-end; flex-direction: column; user-select: none !important" class="image" data-title="{{ $imagem->nome }}">
                <!-- Exibe a imagem armazenada no banco de dados em Base64 -->
                <!-- <img src="data:image/jpeg;base64,{{ $imagem->imagem }}" alt="{{ $imagem->nome }}" oncontextmenu="bloquearBotaoDireito(event)"> -->
                <img id="{{ $imagem->id }}" class="imagemaaa" src="{{ asset("assets/image.png") }}" style="height: auto !important; width: 60% !important; opacity: 0.6 !important; user-select: none">
                 <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; background: white; width: 100%">
                     {{-- <h3>{{ $imagem->nome }}</h3> --}}
                     <div class="compra">
                         <!-- <button id="boton" onclick="window.location.href='{{ route('teste') }}'">COMPRAR IMAGEM</button> -->
                         <button id="boton" onclick="buyImage({{ $imagem->id }})">COMPRAR IMAGEM</button>
                     </div>
                 </div>

            </div>
        @endforeach
    </div>
</div>
<script>
    const buyImage = (id) => {
    window.location.href = `/pagamento/${id}`;
};
</script>


        
        {{-- <input type="text" placeholder="Pesquisar Imagem" id="search-box"> --}}
    
{{-- fotos aqui --}}
    {{-- <script src="/js/main.js"></script>
    <script>
        document.getElementById("sair").addEventListener("click", function(event) {
            event.preventDefault(); 
                window.location.href = "logout.php";          
        });
    </script> --}}
    <script>

        
    const buyImage = (id) => {
        const imagemComprada = document.getElementById(id);
        imagemComprada.style.display = 'none';
    };

    </script>
    <script>
        document.addEventListener('keydown',
            function(e){
                if (e.key === "F12" || (e.ctrlKey && 
            e.shiftKey && e.key === 'I' )) {
                e.preventDefault();
            }
            }
        );

        document.addEventListener('contextmenu',
            function (e){
                e.preventDefault();
            }
        );
    </script>
  
  <script>
        document.getElementById('sair').addEventListener('click', function() {
                document.getElementById('logout-form').submit();
            });
            function bloquearBotaoDireito(event){
                event.preventDefault();
            }
    </script>
    
    
</body>
</html>