<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #success-message {
            background-color: #DEF1D8;
            color: green;
            padding: 10px;
            margin: 10px;
            display: none;
            position: absolute;
            right: 15px;
            top: 15px;
        }

        #error-message {
            background-color: #EFDCDD;
            color: red;
            padding: 10px;
            margin: 10px;
            display: none;
            position: absolute;
            right: 15px;
            top: 15px;
        }

        #modal {
            background-color: rgba(0, 0, 0, 0.7);
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 100;
            display: none;
        }

        #modal-form {
            background-color: #fff;
            width: 30%;
            /* margin: 100px auto; */
            position: relative;
            top: 20%;
            left: calc(50% - 15%);
            padding: 15px;
            border-radius: 4px;
        }

        #modal-form h2 {
            margin: 0 0 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #000;
        }

        #close-btn {
            background-color: red;
            color: white;
            width: 30px;
            height: 30px;
            line-height: 30px;
            text-align: center;
            border-radius: 50%;
            position: absolute;
            top: -15px;
            right: -15px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <table id="main">
        <tr>
            <td id="header">
                <h1>Add Reacords With PHP & Ajax</h1>
            </td>
        </tr>
        <tr>
            <td id="table-form">
                <form id="addForm">
                    First Name: <input type="text" name="" id="fname"><br> <br>
                    Last Name : <input type="text" name="" id="lname">
                    <input type="submit" id="save-button" value="Save">
                </form>
            </td>
        <tr>
            <td id="table-data">

            </td>
        </tr>
        </tr>
    </table>
    <div id="error-message"></div>
    <div id="success-message"></div>
    <div id="modal">
        <div id="modal-form">
            <h2>Edit Form</h2>
            <table cellpadding="10px" width="100%">
            </table>
            <div id="close-btn">X</div>
        </div>
    </div>

    <script src="js/jquery.js"></script>

    <script>
        $(document).ready(function() {
            function loadTable() {
                $.ajax({
                    url: "ajax-load.php",
                    type: "POST",
                    success: function(data) {
                        $("#table-data").html(data)
                    }
                });
            }
            loadTable();

            // Insert Records
            $("#save-button").on("click", function(e) {
                e.preventDefault();
                var fname = $("#fname").val();
                var lname = $("#lname").val();

                if (fname == "" || lname == "") {
                    $("#error-message").html("All Fields Are Required").slideDown();
                    $("#success_message").slideUp();
                } else {
                    $.ajax({
                        url: "ajax-insert.php",
                        type: "POST",
                        data: {
                            first_name: fname,
                            last_name: lname
                        },
                        success: function(data) {
                            if (data == 1) {
                                loadTable();
                                $("#addForm").trigger("reset");
                                $("#success-message").html("Data Inserted Successfully").slideDown();
                                $("#error-message").slideUp();
                            } else {
                                $("#error-message").html("Can't Save Records").slideDown();
                                $("#success_message").slideUp();
                            }
                        }
                    });
                }


            });

            // Delete Records
            $(document).on("click", ".delete-btn", function() {

                if (confirm("Are You Sure")) {

                    var studentId = $(this).data("id");
                    var element = this;

                    $.ajax({
                        url: "ajax-delete.php",
                        type: "POST",
                        data: {
                            id: studentId
                        },
                        success: function(data) {
                            if (data == 1) {
                                $(element).closest("tr").fadeOut();
                            } else {
                                $("#error-message").html("Record Not Deleted").slideDown();
                                $("#success_message").slideUp();
                            }
                        }
                    });
                }
            });

            //show Modal Box
            $(document).on("click", ".edit-btn", function() {
                $("#modal").show();

                var studentId = $(this).data("eid");

                $.ajax({
                    url: "load-update-form.php",
                    type: "POST",
                    data: {
                        id: studentId
                    },
                    success: function(data) {
                        $("#modal-form table").html(data);
                    }
                });
            });


            //Hide Modal Box
            $("#close-btn").on("click", function() {
                $("#modal").hide();
            });
            //Save Update Form
            $(document).on("click", "#edit-submit", function() {

                var stuId = $("#edit-id").val();
                var fname = $("#edit-fname").val();
                var lname = $("#edit-lname").val();

                $.ajax({
                    url: "ajax-update-form.php",
                    type: "POST",
                    data: {
                        id: stuId,
                        first_name: fname,
                        last_name: lname
                    },
                    success: function(data) {

                        if (data == 1) {
                            $("#modal").hide();
                            loadTable();
                        } else {
                            alert("Update Failed");
                        }
                    }
                });
            });
        });
    </script>



</body>

</html>