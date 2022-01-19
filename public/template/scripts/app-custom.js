$(document).ready(function () {
    if (screen.width <= 1024 && screen.width > 767) {
        $(document.body).attr("data-leftbar-compact-mode", 'condensed');
    }

    $(window).resize(function (e) {
        e.preventDefault();
        if (screen.width <= 1024 && screen.width > 767) {
            $(document.body).attr("data-leftbar-compact-mode", 'condensed');
        } else if (!$(document.body).attr("data-leftbar-compact-mode")) {
            //$(document.body).removeAttr("data-leftbar-compact-mode");
        } else if (screen.width > 1024) {
            $(document.body).removeAttr("data-leftbar-compact-mode");
        }

        if (screen.width <= 767) {
            $(document.body).removeAttr("data-leftbar-compact-mode");
        }
    });

    //Activar sidebar derecho
    $('.right-bar-toggle').click(function (e) {
        e.preventDefault();
        $(document.body).toggleClass('right-bar-enabled');
        $('.rightbar-overlay').click(function (e) {
            e.preventDefault();
            $(document.body).removeClass('right-bar-enabled');
        });
    });
    $('right-bar-toggle').click(function () {
        $(document.body).removeClass('right-bar-enabled');
    });
    /*function addClass() {
        $(document.body).toggleClass('right-bar-enabled');
    }
    function delClass() {
        $(document.body).removeClass('right-bar-enabled');
    }*/

    //Funciones del tema de visualización
    //Cambiar de tema
    $("input[name=color-scheme-mode]").click(function () {

        if ($(this).val() == 'on') {
            $(document.body).attr("data-leftbar-theme", 'dark');
            $('#dark-style').removeAttr('disabled');
            $('#light-style').attr("disabled", 'disabled');
        } else {
            $(document.body).removeAttr('data-leftbar-theme');
            $('#light-style').removeAttr('disabled');
            $('#dark-style').attr("disabled", 'disabled');
        }
    });

    //Cambiar tema de sidebar izquierdo
    $("input[name=theme]").click(function () {
        if ($(this).val() == 'default') {
            $(document.body).removeAttr("data-leftbar-theme");
        } else {
            $(document.body).attr("data-leftbar-theme", $(this).val());
        }
    });

    //Cambiar aspecto de sidebar izquierdo
    $("input[name=width]").click(function () {
        $(document.body).attr("data-layout-mode", $(this).val());
    });

    $("input[name=compact]").click(function () {
        $(document.body).attr("data-leftbar-compact-mode", $(this).val());

        if ($(this).val() == 'condensed') {
            $('.simplebar-content-wrapper').css('height', '100%');
            $('.simplebar-content-wrapper').css('overflow', 'hidden');
        } else {
            $('.simplebar-content-wrapper').css('height', '100%');
            $('.simplebar-content-wrapper').css('overflow', 'hidden scroll');
        }
    });

    //Restablecer diseño por defecto
    $('#resetBtn').click(function () {
        $('#light-style').removeAttr('disabled');
        $('#dark-style').attr("disabled", 'disabled');
        $(document.body).attr("data-layout-mode", "fluid");
        $(document.body).removeAttr("data-leftbar-compact-mode");
        $(document.body).removeAttr("data-leftbar-theme");
    });

    //Activar/Desactivar Dorpdown de resultado de busqueda
    $('#top-search').click(function () {
        $('#search-dropdown').toggleClass('d-block');
    });
    $(document).mouseup(function (e) {
        $('#search-dropdown').removeClass('d-block');
    });

    //Dropdown sidebar menú
    $('.side-nav-link').click(function () {
        $('.side-nav-item').removeClass('mm-active');
        $('.mm-collapse').removeClass('mm-show');

        var status = $(this).attr('aria-expanded');

        if (status == 'false') {
            $(this).parent().addClass('mm-active');
            $('.side-nav-link').attr('aria-expanded', false);
            $(this).attr('aria-expanded', true);
            $(this).next().removeClass('mm-collapse');

            $(this).next().addClass('mm-show');
            $(this).next().addClass('mm-collapse');
            $(this).next().removeAttr('style');
        } else {
            $(this).parent().removeClass('mm-active');
            $(this).attr('aria-expanded', false);
            $(this).next().removeClass('mm-show');
            $(this).next().css('height', '0px');
        }

        /*var status =  $(this).attr('aria-expanded');
        alert(status);
        if (status == 'false') {
            $(this).attr('aria-expanded', true);
        }else{
            $(this).attr('aria-expanded', false);
        }*/
    });

    //Activar/Desactivar sidebar izquierdo manualmente(Pantallas pequeñas)
    $('.open-left').click(function () {
        $(document.body).toggleClass('sidebar-enable');
        $(document.body).attr('data-leftbar-compact-mode', function (index, attr) {
            if (attr == 'condensed') {
                $(this).removeAttr('data-leftbar-compact-mode');
            } else {
                return 'condensed';
            }
        });
    });
    /*function changeTheme(element, theme) {

        switch(element) {
            case 'body':
                if (theme == 'dark') {
                    $(document.body).attr("data-leftbar-theme", theme);
                    $('#dark-style').removeAttr('disabled');
                    $('#light-style').attr("disabled", 'disabled');
                }else{
                    $(document.body).removeAttr('data-leftbar-theme');
                    $('#light-style').removeAttr('disabled');
                    $('#dark-style').attr("disabled", 'disabled');
                }
                break;

            case 'leftbar':
                if (theme == 'default') {
                    $(document.body).removeAttr("data-leftbar-theme");
                }else{
                    $(document.body).attr("data-leftbar-theme", theme);
                }
                break;
        }
    }*/
    /*function changeDesign(element, value) {
        switch(element) {
            case 'body':
                $(document.body).attr("data-layout-mode", value);
                break;
            case 'leftbar':
                $(document.body).attr("data-leftbar-compact-mode", value);
                break;
        }
    }*/
    /* function search() {
         $('#search-dropdown').toggleClass('d-block');
     }*/

    //Dropdown sidebar menú
    /*function dropDown() {
        var status =  $('.side-nav-link').attr('aria-expanded');

        if (status == 'false') {
            $('.side-nav-link').addClass('mm-active');
            $('.side-nav-link').attr('aria-expanded', true);
            $('.side-nav-second-level').addClass('mm-show');
        }else{
            $('.side-nav-link').removeClass('mm-active');
            $('.side-nav-link').attr('aria-expanded', false);
            $('.side-nav-second-level').removeClass('mm-show');
        }
    }*/
});