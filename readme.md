# Laravel 5.1 - Multiauth exemplo
Exemplo de  [sboo/multiauth](https://github.com/sboo/multiauth) Combinado com Laravel 5.1 + Socialite

A Utilização do Socialite para login está configurado por padrão para o USER.
O Admin serve de controle adminstrativo não havendo necessidade de ter login com o socialite.

##Instalação
**Clonar Repositorio.**        
    `git clone https://github.com/lucas-macedo/laravel51-multiauth-socialite.git`          
   
**Instalar as dependencias.**        
   Dentro da prasta do projeto  :       
    `composer install`

**Copiar arquivo de configuração**     
   Dentro da prasta do projeto  :          
   `cp .env.example .env`
   
**Gerar chave da aplicação**     
   Dentro da prasta do projeto  :          
    `php artisan key:generate`

**Rodar migrations & seed**     
   Dentro da prasta do projeto  :          
   `php artisan migrate --seed`

**Configurar Facebook**     
   No arquivo config/services.php :          

        'facebook' => [
	        'client_id' => 'YOUR_CLIENT_ID',
	        'client_secret' => 'YOUR_CLIENT_SECRET',
	        'redirect' => 'http://localhost/user/facebook' // URL DE LOGIN FACEBOOK
	    ],

**Rodar aplicação**      
    Dentro da prasta do projeto :       
    `php artisan serve`
    
**User Dashboard login normal**         
    `http://localhost:8000/user/login`    

**User Dashboard login facebook**         
    `http://localhost:8000/user/facebook`  

**Admin Dashboard login**       
    `http://localhost:8000/admin/login`     
    






