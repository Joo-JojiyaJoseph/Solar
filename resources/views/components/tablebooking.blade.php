
    <!--Reservation Section-->
    <section class="reserve-section style-two">
        <div class="image-layer" style="background-image: url({{ asset('/storage/images/background/image-10.jpg') }});"></div>
        <div class="auto-container">
            <div class="outer-box">
                <div class="row clearfix">
                    <div class="reserv-col col-lg-8 col-md-12 col-sm-12">
                        <div class="inner">
                            <div class="title">
                                <h2>Online Reservation</h2>
                                <div class="request-info">Booking request <a href="#">+88-123-123456</a> or fill out the order form</div>
                            </div>
                            <div class="default-form reservation-form">
                                <form method="post" >
                                    @csrf
                                    <div class="row clearfix">
                                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                            <div class="field-inner">
                                                <input type="text" name="name" value="" placeholder="Your Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                            <div class="field-inner">
                                                <input type="text" name="phone" value="" placeholder="Phone Number" required>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                            <div class="field-inner">
                                                <span class="alt-icon far fa-user"></span>
                                                <input type="number" name="person" value="1" placeholder="No of Person" required>Person
                                                <select class="l-icon" name="person">
                                                    <option>1 Person</option>
                                                    <option>2 Person</option>
                                                    <option>3 Person</option>
                                                    <option>4 Person</option>
                                                    <option>5 Person</option>
                                                    <option>6 Person</option>
                                                    <option>7 Person</option>
                                                </select>
                                                <span class="arrow-icon far fa-angle-down"></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-4 col-md-6 col-sm-12">
                                            <div class="field-inner">
                                                <span class="alt-icon far fa-calendar"></span>
                                                <input class="l-icon datepicker" type="date" name="date" value="" placeholder="DD-MM-YYYY" required readonly>
                                                <span class="arrow-icon far fa-angle-down"></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-4 col-md-12 col-sm-12">
                                            <div class="field-inner">
                                                <span class="alt-icon far fa-clock"></span>
                                                <input class="l-icon datepicker" type="time" name="time" value="" placeholder="DD-MM-YYYY" required readonly>
                                                <select class="l-icon">
                                                    <option>08 : 00 am</option>
                                                    <option>09 : 00 am</option>
                                                    <option>10 : 00 am</option>
                                                    <option>11 : 00 am</option>
                                                    <option>12 : 00 pm</option>
                                                    <option>01 : 00 pm</option>
                                                    <option>02 : 00 pm</option>
                                                    <option>03 : 00 pm</option>
                                                    <option>04 : 00 pm</option>
                                                    <option>05 : 00 pm</option>
                                                    <option>06 : 00 pm</option>
                                                    <option>07 : 00 pm</option>
                                                    <option>08 : 00 pm</option>
                                                    <option>09 : 00 pm</option>
                                                    <option>10 : 00 pm</option>
                                                </select>

                                                <span class="arrow-icon far fa-angle-down"></span>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                            <div class="field-inner">
                                                <textarea name="message" placeholder="Message" required></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                            <div class="field-inner">
                                                <button type="submit" class="theme-btn btn-style-one clearfix">
                                                    <span class="btn-wrap">
                                                        <span class="text-one">book a table</span>
                                                        <span class="text-two">book a table</span>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="info-col col-lg-4 col-md-12 col-sm-12">
                        <div class="inner">
                            <div class="img-layer" style="background-image: url({{ asset('/storage/images/background/image-11.jpg') }});"></div>
                            <div class="title">
                                <div class="subtitle">hot deal</div>
                                <h5>Lunch & Dinner Specials</h5>
                            </div>
                            <div class="data">
                                <div class="discount-info">
                                    <div class="s-ttl">up to</div>
                                    <div class="num">45%</div>
                                    <div class="s-ttl">discount</div>
                                </div>
                                <div class="instruction">
                                    • Not valid for online order <br>
                                    • Non-refundable <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

