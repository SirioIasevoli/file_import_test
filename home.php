<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- bootstrap css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <h1 id="name">TEST</h1>
    <button id="test" onclick="test_page.get_data()">test</button>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h3>File read</h3>
                <ul class="list-group" id="file_read"></ul>
            </div>
            <div class="col-6">
                <h3>File written</h3>
                <ul class="list-group" id="file_written"></ul>
            </div>
        </div>
    </div>
    
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <!-- core js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/3.30.2/minified.js" integrity="sha512-u60H4fcHTGKAVICDO65xbPZn/eTY9S/VkZxMBdfwkCaStJH88PELFskcCVXpAAyVsASRhyiyjP3zEVkFd/3KEA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- custom js -->
    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(test_page.get_data(), 3000);
        });
        let test_page = {
            
            get_data: function() {
                $.ajax({
                    url: 'php/file_read.php',
                    type: 'POST',
                    data: $('#name').html(),
                    success: function(res) {
                        console.log(res.data);
                        for(const key in res.data) {
                            $('#file_read').append(
                                `
                                    <li class="list-group-item">
                                        <ul class="list-group">
                                            <li class="list-group-item">${key} - FROM: ${res.folder_name}</li>
                                            <li class="list-group" id="${key}_${res.folder_name}">
                                            </li>
                                        </ul>
                                    </li>
                                `
                            );                            
                        }
                        
 
                        $.ajax({
                            url: 'php/file_write.php',
                            type: 'POST',
                            data : {'data': res.data, 'folder_name': res.folder_name},
                            success: function(result) {
                                $('#file_read').html('');
                                for(const key in result.data) {
                                    $('#file_written').append(
                                        `
                                            <li class="list-group-item">
                                                <ul class="list-group">
                                                    <li class="list-group-item">${key} - TO: ${result.working_dir}</li>
                                                    <li class="list-group" id="${key}_${res.folder_name}">
                                                    </li>
                                                </ul>
                                            </li>
                                        `
                                    );                            
                                }
                            },
                            error: function(e) {
                                console.log(e);
                            }
                        })
                    },
                    error: function(e) {
                        console.log(e);
                    } 
                });
            }
        }       
    </script>
</body>
</html>