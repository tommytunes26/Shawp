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