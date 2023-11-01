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
                                <td>Start Time</td>
                                <td>End Time</td>
                                <td>No of People</td>
                                <td>Amount</td>
                                <td>Status</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                          

                            <?php foreach ($data['reservations'] as $index => $reservation) { ?>
                                <tr>
                                    <td><?php echo $index + 1 ?></td>
                                    <td><?php echo $reservation->reservationID ?></td>
                                    <td><?php echo $reservation->date ?></td>
                                    <td><?php echo $reservation->reservationStartTime  ?></td>
                                    <td><?php echo $reservation->reservationEndTime  ?></td>
                                    <td><?php echo $reservation->numOfPeople ?></td>
                                    <td>Tobecalculated</td>
                                    <td><?php echo $reservation->status ?></td>
                                    <td class="actions">
                                        <a href="<?php echo URLROOT; ?>/Customers/cancelReservation/<?php echo $reservation -> reservationID ?>" class="trash <?php echo  ($reservation->status == 'Cancelled' ? 'disabled-button' : ''); ?>" onclick="return confirm('Are you sure you want to cancel this reservation?');"><i class="fas fa-trash fa-xs"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>


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
                                            <li id="confirm"><strong>Payment</strong></li>
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
                                                                    3% <small>TAX</small>
                                                                </span>
                                                            </span>
                                                            <p class="title">Ethereal Lounge T1</p>
                                                            <p class="info">A serene escape where sophistication and tranquility unite, offering curated cocktails and a menu of culinary delights.</p>
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
                                                            <p class="title">Sapphire Lounge T2</p>
                                                            <p class="info">A celestial retreat, sparkling with opulence. Indulge in carefully crafted beverages and gourmet offerings for an otherworldly experience.</p>
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
                                                            <p class="title">Platinum Lounge T3</p>
                                                            <p class="info">The epitome of luxury, where every detail speaks of excellence. Reserved for connoisseurs who appreciate refined menus and impeccable service.</p>
                                                            <ul class="features">
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pkg-selection">
                                                    <div class="radio-inputs">
                                                        <label class="radio">
                                                            <input type="radio" id="T1"  value= "T1" name="package" checked="">
                                                            <span class="name">T1</span>
                                                        </label>
                                                        <label class="radio">
                                                            <input type="radio"  id="T2" value= "T2"  name="package">
                                                            <span class="name">T2</span>
                                                        </label>

                                                        <label class="radio">
                                                            <input type="radio"  id="T3" value= "T3"  name="package">
                                                            <span class="name">T3</span>
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
                                                            <input type="button" name="confirm" class="confirm-button" value="Confirm" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <input type="button" name="next" class="next action-button " value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
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
                                                    <h3 class="fs-title">Proceed to payment to contunue:</h3>
                                                </div>
                                            </div> <br><br>
                                            <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
                                            <div class="row">
                                            </div> <br><br>
                                        </div><input type="button" name="Payment" class="next action-button" value="Pay Now" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
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