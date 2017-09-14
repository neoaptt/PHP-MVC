<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <?php
            /*this is where we access the information that the controller handed to us*/
            if (is_array($viewbag['ourVar'])) {
                /*we assume it is the data from the database*/
                foreach ($viewbag['ourVar'] as $item) {
                    /*the database had test_id and description and it's two fields we are instrested in printing to the html page*/
                    echo $item['test_id'] . ': ' . $item['description'];
                }
            }
            ?>
        </div>
    </div>
</div>
