<script>

document.addEventListener("DOMContentLoaded", () => {
    load_inventory();
    count_inventory();
 
});

$(document).ready(function(){
    $('#deleteBtn').css('display', 'none');
    // Function to handle select all checkbox
    // $('#select_all').change(function(){
    //     if($(this).is(':checked')){
    //         $('input[name="selected[]"]').prop('checked', true);
    //         $('#deleteBtn').css('display', 'block');
    //     }else{
    //         $('input[name="selected[]"]').prop('checked', false);
    //         $('#deleteBtn').css('display', 'none');
    //     }
    // });

    // Function to handle individual checkboxes
    // $('input[name="selected[]"]').change(function(){
    //     var allChecked = true;
    //     $('input[name="selected[]"]').each(function(){
    //         if(!$(this).is(':checked')){
    //             allChecked = false;
    //             // return false;

    //         }
    //         console.log($(this).val());
    //     });

    //     $('#select_all').prop('checked', allChecked);

    //     if(allChecked) {
    //         $('#deleteBtn').css('display', 'block');
    //     } else {
    //         $('#deleteBtn').css('display', 'none');
    //     }
        
    // });
});


const load_inventory = () => {
    $.ajax({
        url: '../../process/admin/inventory_p.php',
        type: 'POST',
        cache: false,
        data: {
            method: 'inventory_list'
        }, success: function (response) {
            document.getElementById("inventory_table").innerHTML = response;
        }
    });
}

const count_inventory = () => {
    $.ajax({
        type: "POST",
        url: '../../process/admin/inventory_p.php',
        data: {
            method: 'count_list',
            // count: count,
        },
        success: function (response) {
            document.getElementById("count").innerHTML = response;
        }
    });
}

const selectAll = (checkbox) => {
      //check all data
        var select_all = document.getElementById('select_all');
        if (select_all.checked == true) {
            console.log('checked');
            $('.selected').each((i, el) => {
                el.checked = true;
            });
        }
        else {
            console.log('unchecked');
            $('.selected').each((i, el) => {
                el.checked = false;
            });
        }
        get_checked_length();
}

const get_checked_length = () => {
        var arr = [];
        $('input.selected:checkbox:checked').each((i, el) => {
            arr.push($(el).val());
        });
        console.log(arr);
        var numberOfChecked = arr.length;
        if (numberOfChecked > 0) {
            $('#deleteBtn').css('display', 'block');
        }
        else {
            $('#deleteBtn').css('display', 'none');
        }
    }

// delete data arr
const delete_data_arr = () => {
 var arr = [];
    $('input.selected:checkbox:checked').each((i, el) => {
        arr.push($(el).val());
    });
    console.log(arr);

    var numberOfChecked = arr.length;
    if (numberOfChecked > 0) {
        $.ajax({
            url: '../../process/admin/inventory_p.php',
            type: 'POST',
            cache: false,
            data: {
                method: 'delete_data_arr',
                id_arr: arr
            },
            beforeSend: (jqXHR, settings) => {
                Swal.fire({
                    icon: 'info',
                    title: 'Loading',
                    text: 'Please Wait',
                    showConfirmButton: false,
                    timer: 2000
                });
                jqXHR.url = settings.url;
                jqXHR.type = settings.type;
            },
            success: response => {
                setTimeout(() => {
                    swal.close();
                    if (response == 'success') {
                    Swal.fire({
                        icon: 'info',
                        title: 'Data Deleted',
                        text: 'Successfully',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    load_inventory();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: `Error: ${response}`,
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
                }, 500);
            }
        })
        .fail((jqXHR, textStatus, errorThrown) => {
        console.log(jqXHR);
        
        Swal.fire({
            icon: 'error',
            title: 'System Error',
            text: `Error: url: ${jqXHR.url}, method: ${jqXHR.type} ( HTTP ${jqXHR.status} - ${jqXHR.statusText} ) Press F12 to see Console Log for more info.`,
            showConfirmButton: false,
            timer: 2000
        });
        });
    } else {
        Swal.fire({
            icon: 'info',
            title: 'No checkbox checked',
            text: 'No checkbox checked',
            showConfirmButton: false,
            timer: 2000
        })
    }
}
</script>