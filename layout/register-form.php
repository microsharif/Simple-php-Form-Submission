<?php
include("../classes/class-db.php");
include("header.php");
?>
    <div class="main">
        <div class="container">
            <div class="signup-content">
                <div class="signup-img">
                    <img src="../assets/images/form-img.jpg" alt="">
                    <div class="signup-img-content">
                        <h2>Register now </h2>
                    </div>
                </div>
                <div class="signup-form">
                    <div id="server-error"></div>
                    <form class="register-form" id="register-form">
                        <div class="form-row">
                            <div class="form-group">
                                <div class="form-input">
                                    <label for="amount" class="required">Amount</label>
                                    <input type="number" name="amount" id="amount" />
                                </div>
                                <div class="form-input">
                                    <label for="buyer" class="required">Buyer</label>
                                    <input type="text" name="buyer" id="buyer" />
                                </div>
                                <div class="form-input">
                                    <label for="receipt_id" class="required">Receipt ID</label>
                                    <input type="text" name="receipt_id" id="receipt_id" />
                                </div>
                                <div class="form-input">
                                    <label for="buyer_email" class="required">Buyer Email</label>
                                    <input type="email" name="buyer_email" id="buyer_email" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-input">
                                    <label for="items" class="required">Item</label>
                                    <input type="text" id="items" name="items" class="demo-default" value="">
                                </div>
                                <div class="form-input">
                                    <label class="required">Note</label>
                                    <div id="content" class="emj"></div>
                                    <textarea id="note" name="note" rows="1" cols="50"></textarea>
                                </div>
                                <div class="form-input">
                                    <label class="required" for="city">City</label>
                                    <input type="text" name="city" id="city" />
                                </div>
                                <div class="form-input">
                                    <label class="required" for="phone" class="required">Phone number</label>
                                    <input type="number" name="phone" id="phone" />
                                </div>
                                <div class="form-input">
                                    <label class="required" for="entry_by">Entry By</label>
                                    <input type="number" name="entry_by" id="entry_by" />
                                </div>
                            </div>
                        </div>
                        <div class="form-submit">
                            <input type="submit" value="Submit" class="submit" id="submit" name="submit" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include("footer.php"); ?>