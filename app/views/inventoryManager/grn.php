<link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/inventory manager.css">
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/customer-styles.css">
<div class="reservation-container">
    <div class="tabset">
        <input type="radio" name="tabset" id="tab1" aria-controls="view" checked>
        <label for="tab1">View available Stock</label>
        <input type="radio" name="tabset" id="tab2" aria-controls="add">
        <label for="tab2">Add Stocks</label>

        <div class="tab-panels">
            <section id="view" class="tab-panel">
                <div class="content read">
                    <h2>View Available Stocks</h2>
                    <table>
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Name</td>
                                <td>Category</td>
                                <td>Expire Date</td>
                                <td>Quantity</td>
                                <td>Batch Code</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>1001</td>
                                <td>2022-10-01</td>
                                <td>19:00</td>
                                <td>4</td>
                                <td>50.00</td>
                                <td class="actions">
                                    <a href="#" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                                    <a href="" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>1002</td>
                                <td>2022-10-02</td>
                                <td>20:00</td>
                                <td>2</td>
                                <td>30.00</td>
                                <td class="actions">
                                    <a href="#" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                                    <a href="" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>1003</td>
                                <td>2022-10-03</td>
                                <td>18:00</td>
                                <td>6</td>
                                <td>80.00</td>
                                <td class="actions">
                                    <a href="#" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                                    <a href="" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                                </td>
                            </tr>

                            <tr>
                                <td>4</td>
                                <td>1004</td>
                                <td>2022-10-04</td>
                                <td>21:00</td>
                                <td>3</td>
                                <td>45.00</td>
                                <td class="actions">
                                    <a href="#" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                                    <a href="" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                                </td>
                            </tr>

                            <tr>
                                <td>5</td>
                                <td>1005</td>
                                <td>2022-10-05</td>
                                <td>19:30</td>
                                <td>5</td>
                                <td>65.00</td>
                                <td class="actions">
                                    <a href="#" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                                    <a href="" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <div class="pagination">

                        <a href="#"><i class="fas fa-angle-double-left fa-sm"></i></a>
                        <a href="#"><i class="fas fa-angle-double-right fa-sm"></i></a>
                    </div>
                </div>
            </section>

            <section id="add" class="tab-panel">
                <div class="content read">
                    <h2>Add Stocks</h2>
                </div>
                <style>
                    * {
                        box-sizing: border-box;
                    }

                    .card {
                        padding-top: 80px;
                        margin-left: 200px;
                        background-color: white;
                        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                        transition: 0.2s;
                        width: 75%;
                        height: auto;
                        border-radius: 20px;
                    }

                    .card:hover {
                        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);

                    }


                    input[type=text],
                    select,
                    textarea {

                        width: 100%;
                        padding: 12px;
                        border: 1px solid #ccc;
                        border-radius: 4px;
                        resize: vertical;
                    }

                    label {
                        padding: 12px 12px 12px 0;
                        display: inline-block;
                    }

                    input[type=submit] {
                        margin-top: 80px;
                        margin-right: 400px;
                        margin-bottom: 30px;
                        background-color: #04AA6D;
                        color: white;
                        padding: 12px 20px;
                        border: none;
                        border-radius: 4px;
                        cursor: pointer;
                        float: right;
                        width: 20%;
                    }

                    input[type=submit]:hover {
                        background-color: #45a049;
                    }

                    .container {
                        border-radius: 5px;
                        background-color: #f2f2f2;
                        padding: 20px;
                    }

                    .col-25 {
                        margin-left: 180px;
                        float: left;
                        width: 18%;
                        margin-top: 6px;
                    }

                    .col-75 {
                        float: left;
                        width: 50%;
                        margin-top: 6px;
                    }

                    /* Clear floats after the columns */
                    .row:after {
                        content: "";
                        display: table;
                        clear: both;
                    }

                    /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
                    @media screen and (max-width: 600px) {

                        .col-25,
                        .col-75,
                        input[type=submit] {
                            width: 100%;
                            margin-top: 0;
                        }
                    }
                </style>
                <div class="card">
                    <form action="<?php echo URLROOT; ?>/InventoryManagers/grn" method="POST">
                        <div class="row">
                            <div class="col-25">
                                <label for="inventoryname">Inventory Name </label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="inventoryname" name="inventoryname" placeholder="Inventory Name.." required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="category">Category</label>
                            </div>
                            <div class="col-75">
                                <select id="category" name="category" required>
                                    <option value="Vegetables">Vegetables</option>
                                    <option value="Spices">Spices</option>
                                    <option value="Rice">Rice</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="quantitylevel">Current Quantity Level</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="quantitylevel" name="quantitylevel" placeholder="Quantity Level" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="asondate">As On Date</label>
                            </div>
                            <div class="col-75">
                                <input type="date" id="asondate" name="asondate" placeholder="As on Date" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="expiredate">Expire Date</label>
                            </div>
                            <div class="col-75">
                                <input type="date" id="expiredate" name="expiredate" placeholder="Expire Date" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="batchcode">Batch code</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="batchcode" name="batchcode" placeholder="Batchcode" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="description">Description</label>
                            </div>
                            <div class="col-75">
                                <textarea id="description" name="description" placeholder="Write Description.." required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="cost">Cost/Batch</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="cost" name="cost" placeholder="Enter the cost.." required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="quantityaddded">Quantity Added</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="quantityadded" name="quantityadded" placeholder="Enter the new quantity.." required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-25">
                                <label for="roqlevel">ROQ Level</label>
                            </div>
                            <div class="col-75">
                                <input type="text" id="roqlevel" name="roqlevel" placeholder="Enter the new ROQ Level.." required>
                            </div>
                        </div>
                        <div class="row">
                            <input type="submit" value="Save & CLose">
                        </div>

                    </form>
                </div>
            </section>


        </div>
    </div>

</div>