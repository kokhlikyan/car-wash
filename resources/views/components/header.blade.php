<header>
    <a href="">
        <img src="{{url('storage/images/logo.svg')}}" alt="Logo">
    </a>
    <div class="header__menu">
        <nav class="header__nav">
            <ul class="header__ul">
                @php
                $lang = __('header_links')
                @endphp
                @foreach($lang as $link)
                    <li class="header__li">
                        <a href="{{$link['url']}}" class="header__link">{{$link['name']}}</a>
                    </li>

                @endforeach
            </ul>
        </nav>
        <div class="header__buttons">
            <a href="{{app()->currentLocale() == 'en'? 'am': 'en'}}" class="header__change_local">
                {{app()->currentLocale() == 'en'? 'Am': 'En'}}
            </a>
            <button class="btn">{{ __('header_button_text')}}</button>
        </div>
    </div>
</header>
