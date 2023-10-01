<div class="reservation-container">
    <div class="tabset">
        <input type="radio" name="tabset" id="tab1" aria-controls="view" checked>
        <label for="tab1">View Reservations</label>
        <input type="radio" name="tabset" id="tab2" aria-controls="add">
        <label for="tab2">Add Reservation</label>

        <div class="tab-panels">
            <section id="view" class="tab-panel">
                <div class="content read">
                    <h2>View Reservations</h2>
                    <table>
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Reservation ID</td>
                                <td>Date</td>
                                <td>Time</td>
                                <td>No of People</td>
                                <td>Amount</td>
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
                <div class="add-reservation-container">
                    <div class="reservation-container-fluid">
                        <div class=" text-center ">
                            <div class="card">
                                <h2 id="heading" class="text-center">Reserve Slot</h2>
                                <form id="msform" class="msform-container">
                                    <div class="prog">
                                        <ul id="progressbar">
                                            <li class="active" id="package"><strong>Package</strong></li>
                                            <li id="rd"><strong>Reservation Details</strong></li>
                                            <li id="availability"><strong>Availability</strong></li>
                                            <li id="confirm"><strong>Finish</strong></li>
                                        </ul>
                                    </div>
                                    <fieldset>
                                        <div class="form-card">
                                            <div class="row">
                                                <div>
                                                    <h3 class="fs-title">Select the package:</h3>
                                                </div>
                                                <div class="plan-deets">
                                                    <div class="plan">
                                                        <div class="inner">
                                                            <span class="pricing">
                                                                <span>
                                                                    0% <small>TAX</small>
                                                                </span>
                                                            </span>
                                                            <p class="title">p1</p>
                                                            <p class="info">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt qui est voluptates earum et dicta, omnis nobis sunt autem. Eligendi quos ea commodi, tempore veniam ut labore magni odio quae.</p>
                                                            <ul class="features">
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="plan">
                                                        <div class="inner">
                                                            <span class="pricing">
                                                                <span>
                                                                    5% <small>TAX</small>
                                                                </span>
                                                            </span>
                                                            <p class="title">p2</p>
                                                            <p class="info">Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit, praesentium! Nemo praesentium, asperiores maiores laudantium officia vero blanditiis quae? In voluptates fugiat quam doloremque consectetur ea qui ut tenetur nihil?</p>
                                                            <ul class="features">
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="plan">
                                                        <div class="inner">
                                                            <span class="pricing">
                                                                <span>
                                                                    10% <small>TAX</small>
                                                                </span>
                                                            </span>
                                                            <p class="title">p3</p>
                                                            <p class="info">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem, rem. Dicta voluptatibus quasi eos corrupti quia illum provident officiis eaque, explicabo amet maiores voluptate praesentium repellat ipsum! Numquam, dolorem consequatur.</p>
                                                            <ul class="features">
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pkg-selection">
                                                    <div class="radio-inputs">
                                                        <label class="radio">
                                                            <input type="radio" name="radio" checked="">
                                                            <span class="name">p1</span>
                                                        </label>
                                                        <label class="radio">
                                                            <input type="radio" name="radio">
                                                            <span class="name">p2</span>
                                                        </label>

                                                        <label class="radio">
                                                            <input type="radio" name="radio">
                                                            <span class="name">p3</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <input type="button" name="next" class="next action-button" value="Next" />
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-card">
                                            <div class="row">
                                                <div>
                                                    <h3 class="fs-title">Select Date and No of People:</h3>
                                                    <div class="dp-container">
                                                        <div class="row">

                                                            <label for="date">Date:</label>
                                                            <input type="date" id="date" name="date" required>

                                                            <label for="num_people">Number of People:</label>
                                                            <input type="number" id="num_people" name="num_people" min="1" max="10" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <input type="button" name="next" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-card">
                                            <div class="row">
                                                <div>
                                                    <h3 class="fs-title">Select the package:</h3>
                                                </div>

                                                <div class="availability-table">
                                                    <div class="av-table">
                                                        <?php
                                                        echo "<table style='border-collapse: collapse;'>";

                                                        for ($i = 0; $i < 3; $i++) {
                                                            echo "<tr>";
                                                            for ($j = 0; $j < 5; $j++) {
                                                                $slotNumber = $i * 5 + $j + 1;
                                                                echo "<td style='border: none; padding: 5px;'> <div class='slot-container' data-slot-number='$slotNumber'></div></td>";
                                                            }
                                                            echo "</tr>";
                                                        }

                                                        echo "</table>";
                                                        ?>
                                                        <select name="hour" class="slot-selector">
                                                            <?php
                                                            for ($i = 8; $i <= 24; $i++) {
                                                                echo "<option value='$i'>$i:00 AM</option>";
                                                            }
                                                            ?>
                                                        </select>

                                                    </div>


                                                </div>

                                            </div>
                                        </div> <input type="button" name="next" class="next action-button" value="Submit" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-card">
                                            <div class="row">
                                                <div>
                                                    <h3 class="fs-title">Reservation Added Successfully:</h3>
                                                </div>
                                            </div> <br><br>
                                            <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
                                            <div class="row">
                                            </div> <br><br>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

</div>