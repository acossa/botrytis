<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BcDb</title>
    <link rel="stylesheet" type="text/css" href="./css/header.css">
    <link rel="stylesheet" type="text/css" href="./css/content.css">
    <link rel="stylesheet" type="text/css" href="./css/footer.css">
    <link rel="stylesheet" type="text/css" href="./DataTables/datatables.css">
    <script type="text/javascript" src="DataTables/jQuery-3.3.1/jquery-3.3.1.js"></script>
    <script type="text/javascript" charset="utf8" src="./DataTables/datatables.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <div class="heading">
        Botrytis Cynerea Database
    </div>
    <div class="main">

        <input id="tab1" type="radio" name="tabs" checked>
        <label for="tab1">Welcome</label>

        <input id="tab2" type="radio" name="tabs">
        <label for="tab2">Tools</label>

        <input id="tab3" type="radio" name="tabs">
        <label for="tab3">Access BcDb</label>

        <input id="tab4" type="radio" name="tabs">
        <label for="tab4">Contact</label>

        <div class="content">
            <!-- Welcome -->
            <div id="content1">
                <p>
                    Welcome to BcDb
                </p>
            </div>

            <!-- Infos -->
            <div id="content2">
                <h1>
                    How to use BcDb
                </h1>
                <p>
                    <ul>
                        <li>You can browse the database by clicking on the "Access BcDb" menu.</li>
                        <li>...</li>
                        <li>...</li>
                    </ul>
                </p>
            </div>

            <!-- Queries -->
            <div id="content3">
                <p>
                    <?php
                    include('query_form.php'); /*Edit 'query.php' */
                    ?>
                </p>
            </div>

            <!-- Contact -->
            <div id="content4">
                <p>
                    If you have any enquiries please feel free to <a href="mailto:bcdb.webmaster@outlook.com?subject=ProjetWeb">contact us</a>.</br>
                </p>
            </div>
        </div>

    </div>

    <div class="footer">
        <table>
            <tr>
                <th>
                    Documentation
                    <ul>
                        <li>
                            About <i>Botrytis cynerea</i>
                        </li>
                    </ul>
                </th>
            </tr>
        </table>
    </div>
</body>
</html>
