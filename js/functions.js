$('#publicar').click(function() {
    var dataform = new FormData($('#buscarpost')[0]);
    $.ajax({
        data: dataform,
        type: 'POST',
        url: "./php/crearpost.php",
        processData: false,
        contentType: false,
        success:
        function(data){
            $('#resultadocreacion').append(data);
        }
    })
});

$('#login').click(function(){
    var dataform = new FormData($('.form-login')[0]);
    $.ajax({
        data: dataform,
        type: 'POST',
        url: "./php/iniciarsesion.php",
        processData: false,
        contentType: false,
        success:
        function(data){
            console.log(data);
            if(data == true){
                window.location.href = './index.php';
            }else{
                $('#resultado-login').html(data);
            }
            
        }
    })
});

$('#register').click(function(){
    var dataform = new FormData($('.form-register')[0]);
    $.ajax({
        data: dataform,
        type: 'POST',
        url: "./php/crearcuenta.php",
        processData: false,
        contentType: false,
        success:
        function(data){
            console.log(data);
            if(data == true){
                window.location.href = './index.php';
            }else{
                $('#resultado-register').html(data);
            }
            
        }
    })
});