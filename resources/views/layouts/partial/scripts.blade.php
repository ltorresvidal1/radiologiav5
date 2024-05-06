<!-- ================== BEGIN BASE JS ================== -->

<script src="/assets/js/vendor.min.js"></script>
<script src="/assets/js/app.min.js"></script>

<script src="/assets/js/plugins/jszip/jszip.min.js"></script>
<script src="/assets/js/plugins/sweetalert/sweetalert.min.js"></script>
<script src="/assets/js/plugins/select2/select2.min.js"></script>
<!-- ================== END BASE JS ================== 
<script src="/vendor/mckenziearts/laravel-notify/js/notify.js"></script>
-->
    <x-notify::notify />
    @notifyJs
@livewireScripts
@stack('scripts')
