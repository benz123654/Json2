<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Json</title>
</head>

<body>

    <button id="btnBack"> back </button>

    <div id="main">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                </tr>
            </thead>
            <tbody id="tblPost">
            </tbody>
        </table>
    </div>


    <div id="detail">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>UserID</th>
                </tr>
            </thead>
            <tbody id="tbldetails">
            </tbody>
        </table>
    </div>


    <div id="Comments">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody id="tblComments">
            </tbody>
        </table>
    </div>
</body>


<script>

    function refresh() {
        
    }

    function showDetails(id) {
        $("#main").hide();
        $("#detail").show();
        $("#btnBack").show();
        // console.log(id);
        var url = "https://jsonplaceholder.typicode.com/posts/" + id
        var Comments_url = "https://jsonplaceholder.typicode.com/posts/" + id + "/comments"

        $.getJSON(url)
            .done((data) => {
                console.log(data);
                var line = "<tr id='detail'";
                    line += "><td>" + data.id + "</td>"
                    line += "<td><b>" + data.title + "</b><br/>"
                    line += data.body + "</td>"
                    line += "<td>" + data.userId + "</td>"
                    line += "</tr>";
                    $("#tbldetails").append(line);
            })
            .fail((xhr, err, status) => {
            })

            $.getJSON(Comments_url)
            .done((data) => {
                $.each(data, (k, item) => {
                    console.log(data);
                    var line = "<tr id = 'Comments'>";
                    line += "<td>" + item.id + "</td>";
                    line += "<td>" + item.name + "</td>";
                    line += "<td><b>" + item.email + "</b></td>";
                    line += "<td>" + item.body + "</td>";
                    line += "</tr>";
                    $("#tblComments").append(line);
                });
            })
            .fail((xhr, status, error) => {
            })
    }

    function LoadPosts() {
        var url = "https://jsonplaceholder.typicode.com/posts"

        $.getJSON(url)
            .done((data) => {
                $.each(data, (k, item) => {
                    // console.log(item);
                    var line = "<tr>";
                    line += "<td>" + item.id + "</td>"
                    line += "<td><b>" + item.title + "</b><br/>"
                    line += item.body + "</td>"
                    line += "<td><button onClick='showDetails(" + item.id + ");'>Link</button></td>"
                    line += "</tr>";
                    $("#tblPost").append(line);
                });
                $("#main").show();
            })
            .fail((xhr, err, status) => {

            })
    }

    $(() => {
        LoadPosts();
        $("#detail").hide();
        $("#btnBack").click(() => {
            location.reload();
            $("#main").show();
            $("#detail").hide();
            $("#tblComments").show();
        });
    })
</script>

</html>
