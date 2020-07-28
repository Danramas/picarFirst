$ (function () {
        $("#selectMark").change(function () {
            var id_mark = $("#selectMark").val();
            $.get("/php/advert/get_data.php", {id_mark: id_mark, action: 'get_models'}, function (data) {
                var list="";

                data.forEach(function(model) {
                    list+="<option value='"+model.id+"'>"+model.name+"</option>";
                });
                $("#selectModel").html(list);
            });
            $("#selectModif").empty();
            $("#selectModif").prepend( $('<option value="">Select a car modification ...</option>') );
        });

        $("#selectModel").change(function () {
            var id_model = $("#selectModel").val();
            $.get("/php/advert/get_data.php", {id_model: id_model, action:'get_modifs'}, function (data) {
                var list="";
                data.forEach(function(modif) {
                    list+="<option value='"+modif.id+"'>"+modif.name+"</option>";
                });
                $("#selectModif").html(list);
            });
        });
    });
