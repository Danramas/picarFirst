function fillTable(data) {
    var table="";
    data.forEach(function(advert) {
        table+=
            "<td>" +
            "<a href='/php/advert/advert_view.php?advert_id="+advert.id+"'>"+
            "<img width='150' height='100' src='/img/"+advert['img1']+"'>" +
            "<p>"+advert.markName+" "+advert.modelName+" "+advert.modifyName+" "+advert.year+" "+advert.AdDate+"</p>"+
            "</a>" +
            "</td>"
    });
    $("#advertInfo").html(table);
}

$ (function () {
    $("#selectMark").change(filterAdverts);
    $("#selectModel").change(filterAdverts);
    $("#selectModif").change(filterAdverts);

});

function filterAdverts() {
        $("#advertInfo").empty();
        var year1 = $("#inputYear1").val();
        var year2 = $("#inputYear2").val();
        var id_mark = $("#selectMark").val();
        var id_model = $("#selectModel").val();
        var id_modif = $("#selectModif").val();
        var checkbox = document.getElementById("checkImage");

        if (checkbox.checked){
            var isChecked = 1
        }
        else{
            var isChecked = 0;
        }
        $.get("get_data_search.php", {
            year1: year1,
            year2: year2,
            id_mark: id_mark,
            id_model:id_model,
            id_modif: id_modif,
            isChecked: isChecked,
        }, function (data) {
            fillTable(data);
        });
}