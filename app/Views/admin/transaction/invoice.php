<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="theme-color" content="#000000" />
        <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <!-- external css -->
      <link rel="stylesheet" href="<?php echo base_url('admin/css/Invoice.css'); ?>" />
    
        <title>Invoice</title>
        <link rel="icon" type="image/x-icon" href="<?php echo base_url('admin/images/Invoice/download (1).png'); ?>">
    </body>
    <div class="page-content">
    <div class="container-fluid">
    <div class="container mt-3 py-5">
        <div class="row d-flex justify-content-between">
            <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6">
                <div class="col-8 img-section">
                    <img src="<?php echo base_url('/admin/images/'.$invoice_details[0]->logo); ?>" width="200px" height="200px">
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6" style="text-align: right;">
                <div class="d-flex justify-content-end">
                    <div class="col-10 sold">
                        <h2 class="sold-head">Tax Invoice</h2>
                        <p class="sold-adress">(Original for Recipient)</p>
                            
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5 pt-4 d-flex justify-content-between">
            <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6">
                <div class="col-10 sold">
                    <h2 class="sold-head">Sold By :</h2>
                    <p class="sold-adress"><?php echo $invoice_details[0]->company_address; ?>
                        </p>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6" style="text-align: right;">
                <div class="d-flex justify-content-end">
                    <div class="col-10 sold">
                        <h2 class="sold-head">Billing Address :</h2>
                        <p class="sold-adress"><?php echo $user_details['name']; ?><br>
                            <?php echo $user_details['address_line1']; ?><br>
                            <?php echo $user_details['address_line2']; ?><br>
                            <?php echo $user_details['address_line2']; ?>, <?php echo $user_details['address_line2']; ?>, <?php echo $user_details['address_line2']; ?><br>
                            <?php echo $user_details['address_line2']; ?>
                            </p>
                            <h4 class="code-adress mt-3">State/UT Code : <span class="value fw-normal"> <?php echo $user_details['address_line2']; ?></span></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5 d-flex justify-content-between">
            <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6">
                <div class="col-10 sold">
                    <h4 class="code-adress mt-3">PAN No : <span class="value fw-normal"><?php echo $invoice_details[0]->pan; ?></span></h4>
                    <h4 class="code-adress mt-3">GST Registration No : <span class="value fw-normal"> <?php echo $invoice_details[0]->gst; ?></span></h4>
                </div>
            </div>
            <!-- <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6" style="text-align: right;">
                <div class="d-flex justify-content-end">
                    <div class="col-10 sold">
                        <h2 class="sold-head">Shipping Address :</h2>
                        <p class="sold-adress">Shiva
                            304, EW-2, Evershine Pine 1,2,3,4 CHS LTD,,
                            Opp-Gaurav Residency, Mira Road (E), Thane
                            THANE, MAHARASHTRA, 401107
                            IN
                            </p>
                            <h4 class="code-adress mt-3">State/UT Code : <span class="value fw-normal"> 27</span></h4>
                            <h4 class="code-adress mt-3">Place of supply : <span class="value fw-normal">MAHARASHTRA </span></h4>
                    <h4 class="code-adress mt-3">Place of delivery :  <span class="value fw-normal">MAHARASHTRA </span></h4>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="row mt-2 d-flex justify-content-between">
            <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6">
                <!-- <div class="col-10 sold">
                    <h4 class="code-adress mt-3">Order Number : <span class="value fw-normal">404-3259574-4999530</span></h4>
                    <h4 class="code-adress mt-3">Order Date :  <span class="value fw-normal"> 28.09.2022 </span></h4>
                </div> -->
            </div>
            <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6" style="text-align: right;">
                <div class="d-flex justify-content-end">
                    <div class="col-10 sold">
                            <h4 class="code-adress mt-3">Invoice Number :  <span class="value fw-normal"> <?php echo $transaction_details[0]->tr_id; ?></span></h4>
                            <h4 class="code-adress mt-3">Invoice Details : <span class="value fw-normal"> <?php echo $transaction_details[0]->transaction_id; ?> </span></h4>
                    <h4 class="code-adress mt-3">Invoice Date : <span class="value fw-normal"><?php echo date('d-m-Y', strtotime($transaction_details[0]->created)); ?></span></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="container pt-5 mt-3 pb-4 mb-4">
            <table class="table table-bordered mb-0 pb-0" style="border: 1px solid #000;">
                <thead class="thead-dark table-secondary text-dark" style="border: 1px solid #000;;">
                    <tr>
                        <th>Sl.No</th>
                        <th>Description</th>
                        <th>Unit Price</th>
                        <th>Qty</th>
                        <th>Net Amount</th>
                        <th>Tax Rate</th>
                        <th>Tax Type</th>
                        <th>Tax Amount</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>1</td>
                            <td class="pe-5 col-6"><?php echo $invoice_details[0]->add_more_description; ?></td>
                            <td>₹2,230.50</td>
                            <td>1</td>
                            <td>₹2,230.50</td>
                            <td >9%<br><br><br>9%</td>
                            <td>CGST<br><br><br>SGST</td>
                            <td>₹200.75<br><br><br>₹200.75</td>
                            <td>₹2,632.00</td>
                        </tr>
                        <tr>
                            <th colspan="7">Total</th>
                            <th>₹401.50</th>
                            <th>₹2,632.00</th>
                        </tr>
                        <tr>
                            <th colspan="9">Amount in Words:<br>
                                </th>
                        </tr>
                        <tr style="text-align: right;">
                            <th colspan="9">For HotOTT:<br><br>
                                Authorized Signatory</th>
                        </tr>
                </tbody>
            </table>
            <p class="sold-adress mb-3 pb-3">Whether tax is payable under reverse charge - No</p>
            <table class="table table-bordered" style="border: 1px solid #000;">
                <thead class="thead-dark table-light text-dark" style="border: 1px solid #000;;">
                    <tr>
                        <th>Payment Transaction ID : <br> <span class="fw-normal"><?php echo $transaction_details[0]->transaction_id; ?></span></th>
                        <th>Date & Time : <br> <span class="fw-normal"> <?php echo $transaction_details[0]->created; ?></span></th>
                        <th>Invoice Value : <br> <span class="fw-normal"><?php echo $transaction_details[0]->amount; ?></span></th>
                        <th>Mode of Payment : <br> <span class="fw-normal"><?php echo $transaction_details[0]->pay_by; ?></span></th>
                    </tr>
                </thead>
                <input type="hidden" name="trans_id" id="trans_id" value="<?php echo $transaction_details[0]->tr_id; ?>">
            </table>
        </div>
        
    </div>
    </div>
    </div>
</html>