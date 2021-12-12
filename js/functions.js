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
            $('#resultadocreacion').html(data);
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
            if(data == true){
                window.location.href = './index.php';
            }else{
                $('#resultado-register').html(data);
            }
            
        }
    })
});

$('#close').click(function(){
    $.ajax({
        url: "./php/cerrar.php",
        success:
        function(data){
            window.location.href = './index.php';
        }
    })
});

$(document).on('click','#enviarcomentario',function(){
    var texto = $('#nuevocomentario').val();
    var id = $('#userid').val();
    var postid = $('.post').val();
    $.ajax({
        data : {texto : texto, id : id, postid : postid },
        type: "POST",
        url: "./php/guardarcomentario.php",
        success:
        function(data){
            if(!data){
                $('#resultado').html(data);
            }else{
            var postid = $('.post').val();
            $.ajax({
                data : {postid : postid },
                type: "POST",
                url: "./php/cargarcomentarios.php",
                success:
                function(data){
                $('#comentarios').html(data);
                $('#nuevocomentario').val('');
        }
    })
        }}
    })
})

$(document).on('click','.positivo',function(){
    var id = $(this).attr('id');
    var iduser = $('#userid').val();
    $.ajax({
        data : { id : id , iduser : iduser},
        type: "POST",
        url: "./php/guardarvotopositivo.php",
        success:
        function(data){
            $('#resultado').html(data);
        }
    })
})