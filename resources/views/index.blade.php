<!doctype html>
{{-- // @codingStandardsIgnoreFile --}}
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{{ $info->name }}}</title>

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
        <link rel="stylesheet" href="/css/main.css" type="text/css" media="all" />
    </head>
    <body>
        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
            <header class="mdl-layout__header">
                <div class="mdl-layout__header-row">
                    <div class="mdl-layout-spacer"></div>
                    <nav class="mdl-navigation mdl-layout--large-screen-only">
                        <a class="mdl-navigation__link" href="">Link</a>
                    </nav>
                </div>
            </header>

            <div class="mdl-layout__drawer">
                <nav class="mdl-navigation">
                    <a class="mdl-navigation__link" href="">Link</a>
                </nav>
            </div>

            <main class="mdl-layout__content">

                <section class="section--center mdl-grid mdl-grid--no-spacing info-section text-center">
                    <div class="mdl-cell mdl-cell__info mdl-cell--12-col">
                        {{{ $info->phoneOne . ' | ' . $info->street . ', ' . $info->city . ', ' . $info->state . ' ' . $info->zip }}}
                    </div>
                </section>

                <section class="mdl-grid title-section mdl-shadow--2dp">
                    <div class="mdl-cell mdl-cell--12-col text-center">
                        <h1>{{{ $info->name }}}</h1>
                    </div>
                </section>

                <section class="section--center mdl-grid">
                    <div class="mdl-card mdl-cell mdl-cell--12-col text-center mdl-shadow--2dp">
                        <div class="mdl-card__title mdl-card--border">
                            <h2 class="mdl-card__title-text">{{{ $about->title }}}</h2>
                        </div>
                        <div class="mdl-card__supporting-text mdl-card--prewrap">
                            {{{ $about->content }}}
                        </div>
                    </div>
                </section>

                <section class="section--center mdl-grid">
                    <div class="mdl-card mdl-cell mdl-cell--12-col text-center mdl-shadow--2dp">
                        <div class="mdl-card__title mdl-card--border">
                            <h2 class="mdl-card__title-text">Menu</h2>
                        </div>
                        <div class="mdl-card__supporting-text">
                        @foreach($menuSections as $menuSection)
                            <h5>{{{ $menuSection->name }}}</h5>
                            <div class="mdl-grid">
                            @foreach($menuSection->items as $item)
                                <div class="section__text mdl-cell mdl-cell--6-col mdl-cell--4-col-tablet md-cell-4--col-phone">
                                    <h6>{{{ $item->name }}}</h6>
                                    @if(isset($item->description))
                                    <p>{{{ $item->description }}}</p>
                                    @endif
                                    <div class="section__prices">
                                        @if($menuSection->itemPrices === 2)
                                        small: {{{ number_format($item->priceOne, 2)}}} - large: {{{ number_format($item->priceTwo, 2) }}}
                                        @else
                                        {{{ number_format($item->priceOne, 2) }}}
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        @endforeach
                        </div>
                    </div>
                </section>

                <section class="section--center mdl-grid">
                    <div class="mdl-card mdl-cell mdl-cell--12-col text-center mdl-shadow--2dp">
                        <div class="mdl-card__title mdl-card--border">
                            <h2 class="mdl-card__title-text">Photos</h2>
                        </div>
                        <div class="mdl-card__supporting-text mdl-grid">
                            <div class="mdl-card mdl-card__image mdl-shadow--2dp mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--4-col-phone" style="background: url('/images/cityscape1.jpg') center / cover;">
                                <div class="mdl-card__title mdl-card--expand"></div>
                                <div class="mdl-card__actions">
                                    <span>Image.jpg</span>
                                </div>
                            </div>
                            <div class="mdl-card mdl-card__image mdl-shadow--2dp mdl-cell--4-col-desktop mdl-cell--4-col-tablet mdl-cell--hide-phone" style="background: url('/images/cityscape1.jpg') center / cover;">
                                <div class="mdl-card__title mdl-card--expand"></div>
                                <div class="mdl-card__actions">
                                    <span>Image.jpg</span>
                                </div>
                            </div>
                            <div class="mdl-card mdl-card__image mdl-shadow--2dp mdl-cell--4-col-desktop mdl-cell--hide-phone mdl-cell--hide-tablet" style="background: url('/images/cityscape1.jpg') center / cover;">
                                <div class="mdl-card__title mdl-card--expand"></div>
                                <div class="mdl-card__actions">
                                    <span>Image.jpg</span>
                                </div>
                            </div>
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">Previous</a>
                            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect right-text">Next</a>
                        </div>
                    </div>
                </section><!-- .photo-section -->

                <footer class="mdl-mega-footer">
                    <div class="mdl-mega-footer__top-section mlg-grid text-center">
                        <div class="mdl-mega-footer__left-section mdl-cell--6-col mdl-cell--4-col-tablet">
                            <h6 class="mdl-mega-footer__heading">{{{ $info->name }}}</h6>
                            <ul class="mdl-mega-footer__link-list">
                                <li>{{{ $info->street . ', ' . $info->city }}}</li>
                                <li>{{{ $info->state . ' ' . $info->zip }}}</li>
                                <li>{{{ $info->phoneOne }}}</li>
                                @if($info->phoneTwo)
                                <li>{{{ $info->phoneTwo }}}</li>
                                @endif
                            </ul>
                        </div>

                        <div class="mdl-mega-footer__left-section mdl-cell--6-col mdl-cell--4-col-tablet">
                            <h6 class="mdl-mega-footer__heading">Hours</h6>
                            <ul class="mdl-mega-footer__link-list">
                                @foreach($hours as $hour)
                                <li>{{{ $hour->day }}}: {{{ ($hour->isClosed) ? 'Closed' : $hour->open . ' - ' . $hour->close }}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="mdl-mega-footer__bottom-section mdl-nospacing">
                        <div class="mdl-logo">Made with &#9829 by NC</div>
                        <ul class="mdl-mega-footer__link-list mdl-nospacing">
                            <li><a href="/dash/#login">Login</a></li>
                        </ul>
                    </div>
                </footer>

            </main>
        </div>
        <script type="text/javascript" src="/js/main.js"></script>
    </body>
</html>
