function CarregaDdlModelo() {
    let CodMarca = $( "#_ddlMarca option:selected" ).val();//$("#_ddlMarca").val();  
    var obj = {
        CODMARCA: CodMarca,
    };

    //var param = JSON.stringify(obj);

    $.ajax({
        url: "service/BuscaModelos.php?codMarca="+CodMarca,
        type: 'GET',
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (data) {
            debugger;
            console.log(data);
            var selectbox = $('#_ddlModelo');
            selectbox.find('option').remove();
            data.forEach(function(o, index){
                $('<option>').val(o.MODCOD).text(o.MODDESCRICAO).appendTo(selectbox);
            });
            $('<option>').val('0').text('Selecionar').appendTo(selectbox);
            $('#_ddlModelo option[value=0]').attr('selected','selected');
            
        }
    });
}



//Altera Painel
function AlternaPainel(s, h) {
    //s -> Tela a ser mostrada
    //h -> Tela a ser ocultada
    $("#" + h).removeClass("display-show");
    $("#" + h).addClass("display-hide");
    $("#" + s).removeClass("display-hide");
    $("#" + s).addClass("display-show");
}