<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}}</title>
    <meta name="description" content="">

    <!-- Tailwind -->
    {{--<link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">--}}
    <link rel="stylesheet" href="/assets/css/tailwind-2.2.9.min.css">

    <link rel="stylesheet"
            href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');

        .font-family-karla {
            font-family: karla;
        }
    </style>

    @livewireStyles

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9" ></script>

</head>
<body class="bg-white font-family-karla h-screen">


@yield('base')

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>

@livewireScripts

@stack('scripts')


<script>
    window.System = window.System || {};
    (function(){
        let loading;
        let activityMessageText = 'Working...';

        window.System = Object.assign(window.System, {
            setActivityMessageText(text = 'Working...'){
                activityMessageText = text;
            }
        });


        const Toast = window.Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            onOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });

        const Alert = window.Swal.mixin({
            allowOutsideClick: false,
            allowEscapeKey: false,
        });

        const ConfirmModal = window.Swal.mixin({
            showConfirmButton: true,
            showCancelButton: true,
        })

        window.System = Object.assign(window.System, {
            alert(title, content, icon, showConfirmButton = false){
                return Alert.fire({
                    title: title,
                    icon: icon,
                    html: content,
                    showConfirmButton: showConfirmButton,
                });
            },
            toast(message, type = 'info'){
                return Toast.fire({
                    icon: type,
                    html: message
                })
            },
            activityAlert(text){
                let loading_anim = '<div class="loader ease-linear rounded-full border-2 border-t-1 border-gray-200 inline-block mr-7 h-4 w-4 align-middle"></div>';
                return this.alert(loading_anim, '<p class="text-center text-info">' + text + '</p>');
            },

            confirmModal(message, title = 'Are you sure?', type = 'question'){
                return ConfirmModal.fire({
                    icon: type,
                    html: message,
                    title: title,
                })
            },

        });


    }());
    window.addEventListener('notification', event => {
        const evtData = event.detail;

        window.Swal.close();

        if (evtData.type === 'loading') {

            window.System.activityAlert(evtData.message || 'Loading...');
        }

        if (evtData.type === 'toast') {

            window.System.toast(evtData.message, evtData.messageType || 'info');
        }

    })
</script>
</body>
</html>
