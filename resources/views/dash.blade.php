<!doctype html>
{{-- // @codingStandardsIgnoreFile --}}
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Management Dashboard</title>

        <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold&amp;lang=en" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="/css/dash.css" type="text/css" media="all" />
    </head>
    <body>
        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
            <header class="mdl-layout__header">
                <div class="mdl-layout__header-row header">
                </div>
            </header>
            <div class="mdl-layout__drawer navigation">
                <nav class="mdl-navigation navigation">
                    <div class="auth-links" style="display:none">
                        <a class="mdl-navigation__link" href="#login">Login</a>
                        <a class="mdl-navigation__link" href="#create">Create Account</a>
                        <a class="mdl-navigation__link" href="#forgot">Reset Password</a>
                    </div>
                    <div class="content-links" style="display:none">
                        <a class="mdl-navigation__link" href="#">Home</a>
                        <a class="mdl-navigation__link" href="#info">Info</a>
                        <a class="mdl-navigation__link" href="#about">About</a>
                        <a class="mdl-navigation__link" href="#menu">Menu</a>
                        <a class="mdl-navigation__link" href="#pictures">Pictures</a>
                        <a class="mdl-navigation__link" href="#hours">Hours</a>
                        <a class="mdl-navigation__link" href="#logout">Logout</a>
                    </div>
                </nav>
            </div>
            <main class="mdl-layout__content">
                <div class="mdl-grid page-content content"></div>
            </main>
            <div class="loading-overlay" style="display:none">
                <div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate"></div>
            </div>
        </div>
        <script type="text/javascript" src="/js/dash.js"></script>
    </body>
</html>
