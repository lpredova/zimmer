/**
 * Created by lovro on 05/12/14.
 */
function initDatatables(element, source_url) {
    console.log('datatableee')


    var oTable;
    oTable = element.dataTable({

        "bProcessing": true,
        "bServerSide": false,
        "sAjaxSource": source_url
    });
    return oTable;
}

function setIframeListener() {
    $('*[data-toggle="iframe-modal"]').on("click", function () {
        var src = $(this).attr("data-iframe-src");
        $("#iframe-modal iframe").attr("src", src);
        modal = $("#iframe-modal").modal();
    });
}