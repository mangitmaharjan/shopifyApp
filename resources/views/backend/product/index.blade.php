@extends('shopify-app::layouts.default')

@section('content')
    <!-- You are: (shop domain name) -->
    THIS iS PRODUCT PAGE
    <a href="/">GO</a>
@endsection

@section('scripts')
    @parent

    <script type="text/javascript">
        var AppBridge = window['app-bridge'];
        var actions = AppBridge.actions;
        var TitleBar = actions.TitleBar;
        var Button = actions.Button;
        var Redirect = actions.Redirect;
        var titleBarOptions = {
            title: 'Product',
        };
        var myTitleBar = TitleBar.create(app, titleBarOptions);
        alert('HI');
    </script>
@endsection
