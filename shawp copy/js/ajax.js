/*Ajax calls to db------------------------------------*/

$(document).ready(function (e) {
    
    $('#submitSet').on('click', function () {
        
        var check = $('#add').val();
        
        //Validate if amount has been submitted
        if (check !== ''){
            
            event.preventDefault();

            var studentID = $('#id').val();
            var add = $('#add').val();
            var fileData = $('#file').prop('files')[0];

            var formData = new FormData();        
            formData.append('file', fileData);
            formData.append('studentID', studentID);
            formData.append('add', add);

            $.ajax({
                url: 'setConfig.php',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                type: 'post',
                success: function (data) {
                    bootbox.alert({
                            size: "small",
                            backdrop: true,
                            animate: true,
                            message: data,
                        }); 

                        // Clear the form.
                        $('#id').val('');
                        $('#add').val('');
                        $('#file').val('');                
                    },
                    error: function(){
                        bootbox.alert({
                            size: "small",
                            backdrop: true,
                            animate: true,
                            title: 'Failed!',
                            message: 'ERROR',
                        }); 
                    }
            });
        
        } else {
            bootbox.alert({
                size: "small",
                backdrop: true,
                animate: true,
                title: 'Failed!',
                message: 'Please enter an Amount',
            }); 
        }
        
    });
    
    $('#submitAdd').on('click', function () {
        
        var check = $('#add').val();
        
        //Validate if amount has been submitted
        if (check !== ''){
            
            event.preventDefault();

            var studentID = $('#id').val();
            var add = $('#add').val();
            var fileData = $('#file').prop('files')[0];

            var formData = new FormData();        
            formData.append('file', fileData);
            formData.append('studentID', studentID);
            formData.append('add', add);

            $.ajax({
                url: 'addConfig.php',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                type: 'post',
                success: function (data) {
                    //Trim returned whitespace
                    var check = $.trim(data);
                    //Verify if returned result was empty
                    if (check == '') {
                        
                        bootbox.alert({
                            size: "small",
                            backdrop: true,
                            animate: true,
                            message: "<span style='color:#930b00'>Student not found! </span><p> Please use <b>'Set Points'</b> to add student. </p>",
                        }); 

                        // Clear the form.
                        $('#id').val('');
                        $('#add').val('');
                        $('#file').val('');
                        
                    } else {
                        
                        bootbox.alert({
                            size: "small",
                            backdrop: true,
                            animate: true,
                            title: 'Success!',
                            message: data,
                        }); 

                        // Clear the form.
                        $('#id').val('');
                        $('#add').val('');
                        $('#file').val('');
                        
                    }
                    
                                    
                    },
                    error: function(){
                        bootbox.alert({
                            size: "small",
                            backdrop: true,
                            animate: true,
                            title: 'Failed!',
                            message: 'ERROR',
                        }); 
                    }
            });
        
        } else {
            bootbox.alert({
                size: "small",
                backdrop: true,
                animate: true,
                title: 'Failed!',
                message: 'Please enter an Amount',
            }); 
        }
        
    });
    
    $('#submitSubtr').on('click', function () {
        
        var check = $('#subtract').val();
        
        //Validate if amount has been submitted
        if (check !== ''){
            
            event.preventDefault();

            var studentID = $('#id').val();
            var subtr = $('#subtract').val();

            var formData = new FormData();        
            formData.append('studentID', studentID);
            formData.append('subtr', subtr);

            $.ajax({
                url: 'subtrConfig.php',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                type: 'post',
                success: function (data) {
                    bootbox.alert({
                            size: "small",
                            backdrop: true,
                            animate: true,
                            message: data,
                        }); 

                        // Clear the form.
                        $('#id').val('');
                        $('#subtract').val('');              
                    },
                    error: function(){
                        bootbox.alert({
                            size: "small",
                            backdrop: true,
                            animate: true,
                            title: 'Failed!',
                            message: 'ERROR',
                        }); 
                    }
            });
        
        } else {
            bootbox.alert({
                size: "small",
                backdrop: true,
                animate: true,
                title: 'Failed!',
                message: 'Please enter an Amount',
            }); 
        }
        
    });
    
});

/*----------------------------------------------------*/

/*////////////////////////////////////////////////////*/

/*Point Summary functions-----------------------------*/

function printSum(){    
    
    //alert("huh?");

    $.ajax({
        url: 'printConfig.php',
        dataType: 'text',
        data: {action: 'print'},
        type: 'post',
        success: function (data) {
            bootbox.alert({
                    size: "medium",
                    title: "Points Summary",
                    backdrop: true,
                    animate: true,
                    message: data,
                });             
            },
            error: function(){
                bootbox.alert({
                    size: "small",
                    backdrop: true,
                    animate: true,
                    title: 'Failed!',
                    message: 'ERROR',
                }); 
            }
    });
    
}

function exportFile(){
    
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var textRange; var j=0;
    tab = document.getElementById('points-table'); // id of table

    for(j = 0 ; j < tab.rows.length ; j++) 
    {     
        
        tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
        
    }

    tab_text=tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // removes input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE "); 

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
    }  
    else                 //other browser not tested on IE 11
        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

    return (sa);
    
}

function printFile(){
    
   var divToPrint=document.getElementById("points-table");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
    
}

/*-----------------------------------------------------*/