<html>
<head>
    <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
</head>


<body>

<div class="container-fluid">
    <div class="col-md-12 col-xs-12 col-lg-12">
        <div class="row justify-content-md-center" style="margin-top: 50px;">
            <div class="col-md-5">
                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">
                    <div class="errorM">
                        <ul id="menu_error">

                        </ul>

                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <form method="post">
                    <div class="form-group" id="appendHidden">
                        <label for="item_name">Item Name:</label>
                        <input type="text" name="item_name" class="form-control" placeholder="Item Name" id="item_name" required>
                        <input type="hidden" name="item_id" class="form-control" id="item_id">
                    </div>
                    <div class="form-group">
                        <label for="item_quantity">Item Quantity:</label>
                        <input type="number" name="item_quantity" class="form-control" placeholder="Item Price" id="item_quantity" required>
                    </div>

                    <div class="form-group">
                        <label for="item_amount">Item Price:</label>
                        <input type="number" name="item_amount" class="form-control" placeholder="Item Amount" id="item_amount" step=".01" required>
                    </div>

                    <br>
                    <!-- BUTTONS -->
                    <button onclick="submitForm()" id="add_button" type="button" name="add_items" class="btn btn-primary">ADD ITEM</button>
                    <button onclick="submitFormEdit()" id="edit_button" type="button" name="add_items" class="btn btn-primary">EDIT ITEM</button>
                    <button onclick="resetButton()" id="reset_button" type="button" name="add_items" class="btn btn-primary">ADD ITEM</button>
                </form>
            </div>

            <div class="col-md-6">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="itemBody">

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>




</body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script>
    $(document).ready(function (){
        $('.alert').hide();
        $('#edit_button').hide();
        $('#reset_button').hide();

        //function for getting all items
        $.ajax({
           url:'/ExamNew/controller/main.controller.php',
           type:'GET',
           data:{
               getItem:'1',
           },success: function (data) {
                $("#itemBody").empty();
                var td = "";

                for (i = 0; i < data.length; i++) {
                    td += "<tr>";
                    td += "<td>" + data[i]['item_name'] + "</td>";
                    td += "<td>" + data[i]['item_quantity'] + "</td>";
                    td += "<td>" + data[i]['item_amount'] + "</td>";
                    td += '<td><a class="btn btn-primary" onclick="editItem(\'' + data[i]['item_id'] + '\')" >Edit</a> | <a class="btn btn-danger" onclick="deleteItem(\'' + data[i]['item_id'] + '\')">Delete</a></td>';
                    td += "</tr>";
                }

                $("#itemBody").append(td);
           },dataType: 'json'

        });


    });


</script>


</html>


<script>
    //function for adding item
    function submitForm() {
        $.ajax({
            url:'/ExamNew/controller/main.controller.php',
            type:'POST',
            data:{
                add_item:'1',
                item_name:$('#item_name').val(),
                item_quantity:$('#item_quantity').val(),
                item_amount:$('#item_amount').val(),
            },success: function (data) {
                if (data[0] === "Success") {
                    $('.alert').hide();
                    if(confirm("Please click OK to see changes.")){
                        window.location.reload();
                    }
                }
                else {

                    $("#menu_error").empty();
                    var li = "";

                    for (i = 0; i < data.length; i++) {
                        li += "<li>" + data[i] + "</li>";
                    }
                    $("#menu_error").append(li);
                    $('.alert').show();
                }
            },dataType:'json'


        });
    }

    //function for updating items
    function submitFormEdit() {
        $.ajax({
            url:'/ExamNew/controller/main.controller.php',
            type:'POST',
            data:{
                update_item:'1',
                item_id:$('#item_id').val(),
                item_name:$('#item_name').val(),
                item_quantity:$('#item_quantity').val(),
                item_amount:$('#item_amount').val(),
            },success: function (data) {
                if (data[0] === "Success") {
                    $('.alert').hide();
                    if(confirm("Please click OK to see changes.")){
                        window.location.reload();
                    }
                }
                else {

                    $("#menu_error").empty();
                    var li = "";

                    for (i = 0; i < data.length; i++) {
                        li += "<li>" + data[i] + "</li>";
                    }
                    $("#menu_error").append(li);
                    $('.alert').show();
                }
            },dataType:'json'


        });
    }

    // get the item per item_id
    function editItem(id) {
        $('#edit_button').show();
        $('#reset_button').show();
        $('#add_button').hide();

        $("#item_id").val(id);

        $.ajax({
            url:'/ExamNew/controller/main.controller.php',
            type:'GET',
            data:{
                getItemData:'1',
                item_id:id,
            },success:function (data) {
                $('#item_name').val(data['item_name']);
                $('#item_quantity').val(data['item_quantity']);
                $('#item_amount').val(data['item_amount']);
            },dataType:'json'

        });


    }

    //reset the buttons and the input's
    function resetButton() {
        $('#edit_button').hide();
        $('#reset_button').hide();
        $('#add_button').show();

        $('#item_id').val('');
        $('#item_name').val('');
        $('#item_quantity').val('');
        $('#item_amount').val('');
    }

    //function for deleting item
    function deleteItem(id) {

        if(confirm("Are you sure you want to delete this item?")){
            $.ajax({
                url:'/ExamNew/controller/main.controller.php',
                type:'POST',
                data:{
                    delete_item:'1',
                    item_id:id,
                },success: function (data) {
                    if(data[0] === 'Success'){
                        window.location.reload();
                    }
                },dataType:'json'

            });
        }else{

        }

    }



</script>