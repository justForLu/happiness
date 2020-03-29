<script src="{{asset("/assets/home/layui/layui.js")}}"></script>
<!--[if lt IE 9]>
<script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
<script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script>
    layui.config({
        base: '{{asset("/assets/home/js/")}}'
    }).use('/firm');
</script>