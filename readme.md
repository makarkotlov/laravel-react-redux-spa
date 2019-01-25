<h1>Task management SPA with React-Redux and Laravel.</h1>
<ul>
    <li>Laravel Echo broadcasting, laravel-echo-server and Redis for real time expirience.</li>
    <li>Responsive Materialize CSS layout.</li>
    <li>MySQL.</li>
    <li>JWT authentication.</li>
    <li>React-Redux.</li>
</ul>    

<h1>Install</h1>
<ul>
    <li>composer install</li>
    <li>npm install</li>
    <li>npm install -g laravel-echo-server</li>
    <li>npm install pm2 -g (background tasks)</li>
    <li>create .env file</li>
    <li>php artisan key:generate</li>
    <li>php artisan migrate</li>
    <li>php artisan storage:link</li>
    <li>laravel-echo-server init (use https for browser push notifications)</li>
    <li>chmod 755 public/js/sw.js</li>
    <li>chown root:www-data public/js/sw.js</li>
</ul>

<h1>Developer Run</h1>
<ul>
    <li>laravel-echo-server start</li>
    <li>php artisan queue:work</li>
</ul>
