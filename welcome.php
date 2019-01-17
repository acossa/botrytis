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
        <!-- <div class="main_menu"> -->
            <input id="tab1" type="radio" name="tabs" checked>
            <label class="menu" for="tab1">Welcome</label>

            <input id="tab2" type="radio" name="tabs">
            <label class="menu" for="tab2">Tools description</label>

            <input id="tab3" type="radio" name="tabs">
            <label class="menu" for="tab3">Access BcDb</label>

            <input id="tab4" type="radio" name="tabs">
            <label class="menu" for="tab4">Contact</label>
        <!-- </div> -->
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
                <div style="width:50%">
                    <p>
                        <ul>
                            <li>
                                This website presents omics data from the fungus <i>Botrytis cinerea</i>, more commonly called gray mould. You can browse the database by clicking on the "Access BcDb" menu. In that section you will be able to search the database by using a specific gene locus, or browse by region or by protein name.
                            </li>
                            <li>
                                If you want more informations about <i>Botrytis cinerea</i>, here is its <a href="https://en.wikipedia.org/wiki/Botrytis_cinerea" target="_blank">Wikipedia page</a>. If you want to browse recent articles you can clic on one of the following links:
                                <ul>
                                    &emsp;<li>
                                        &emsp;<a href="https://www.ncbi.nlm.nih.gov/pubmed/?term=botrytis+cinerea" target="_blank">PubMed<a>
                                    </li>
                                    &emsp;<li>
                                        &emsp;<a href="https://www.researchgate.net/search?q=botrytis%20cinerea" target="_blank">ResearchGate<a>
                                    </li>
                                    &emsp;<li>
                                        &emsp;<a href="https://scholar.google.fr/scholar?hl=fr&as_sdt=0%2C5&as_vis=1&q=botrytis+cinerea&btnG=" target="_blank">Google Scholar<a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </p>
                </div>
            </div>

            <!-- Queries -->
            <div id="content3">
                <p>
                    <?php
                    include('query_form.php'); /*Edit 'query.php' */
                    ?>
                </p>
            </div>

            <!-- Blast -->
            <!-- <div id="content4">
                <p>
                    <?php
                    // include('blast.php');
                    ?>
                </p>
            </div> -->

            <!-- Contact -->
            <div id="content4">
                <p>
                    If you have any enquiries please feel free to <a href="mailto:bcdb.webmaster@outlook.com?subject=ProjetWeb">contact us</a>.</br>
                </p>
            </div>
        </div>

    </div>

    <div class="footer">
        <!-- <table>
            <tr>
                <th>
                    Documentation
                    <ul>
                        <li>
                             About <i>Botrytis cynerea</i> -->
                            <p>Botrytis cinerea Database 2019</p>
                        <!-- </li>
                    </ul>
                </th>
            </tr>
        </table> -->
    </div>
</body>
</html>
