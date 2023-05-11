
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
       
    </head>
    <body>
        <div class="card">
            <div class="card-body">
                <div class="container mb-5 mt-3">
                    <h3 class="fw-normal mb-0 text-black">Payment</h3>
                    <div class="row d-flex align-items-baseline mt-3" >
                        <div class="col-xl-9">
                            <p class="text-capitalize">invoice no. <strong>${payments[0].paymentNo}</strong></p>
                        </div>
                        <hr/>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-xl-8">
                                <ul class="list-unstyled">
                                    <li class="text-muted">
                                        <span class=" text-capitalize">Customer:</span>
                                        <span class="fw-bold">${payments[0].customerName}</span>
                                    </li>
                                    <li class="text-muted w-75">
                                    <li class="text-muted">
                                        <span class="text-capitalize">payment method:</span>
                                        <span class="fw-bold">${payments[0].paymentMethod}</span>
                                    </li>
                                    <li class="text-muted">
                                        <span class="text-capitalize">address:</span>
                                        <span class="fw-bold">${func:replace(payments[0].order.deliveryAddress, ".", ", ")}</span>
                                    </li>
                                    <li class="text-muted">
                                        <span class="text-capitalize">delivery fee: </span>
                                        <span class="fw-bold">RM
                                            <fmt:formatNumber value="${payments[0].deliveryFee}" type="number" minFractionDigits="2"/>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xl-4">
                                <ul class="list-unstyled">
                                    <li class="text-muted">
                                        <i class="fas fa-circle"></i> 
                                        <span class="fw-bold text-capitalize">creation date:</span>
                                        <span class="">${payments[0].createdDate}</span>
                                    </li>
                                    <li class="text-muted">
                                        <i class="fas fa-circle">
                                        </i> <span class="me-1 fw-bold text-capitalize">price:</span>
                                        <span class="">RM 
                                            <fmt:formatNumber value="${payments[0].price}" type="number" minFractionDigits="2"/>
                                        </span>
                                    </li>
                                    <li class="text-muted">
                                        <i class="fas fa-circle">
                                        </i> <span class="me-1 fw-bold text-capitalize">status:</span>
                                        <span class="badge bg-info fw-bold text-uppercase">${payments[0].order.status}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="row my-2 mx-1 justify-content-center">
                            <table class="table table-striped table-borderless" id="table-invoice-item">
                                <thead class="text-white bg-secondary">
                                    <tr>
                                        <th scope="col" class="fw-bold text-capitalize">product</th>
                                        <th scope="col" class="fw-bold text-capitalize">color</th>
                                        <th scope="col" class="fw-bold text-capitalize">size</th>
                                        <th scope="col" class="fw-bold text-capitalize">quantity</th>
                                        <th scope="col" class="fw-bold text-capitalize">unit price (RM)</th>
                                        <th scope="col" class="fw-bold text-capitalize">price (RM)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <pre:forEach items="${payments}" var="payment">
                                        <pre:forEach items="${payment.order.orderDetail}" var="orderDetail">
                                            <tr>

                                                <td><pre:out value="${orderDetail.productName}"/></td>
                                                <td><pre:out value="${orderDetail.color}"/></td>
                                                <td><pre:out value="${orderDetail.size}"/></td>
                                                <td><pre:out value="${orderDetail.quantity}"/></td>
                                                <td><fmt:formatNumber value="${orderDetail.price}" type="number" minFractionDigits="2"/></td>
                                                <td><fmt:formatNumber value="${orderDetail.price * orderDetail.quantity}" type="number" minFractionDigits="2"/></td>
                                            </tr>
                                        </pre:forEach>
                                    </pre:forEach>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
        <script src="../../../Scripts/FrontOffice/Payment/Fo.PaymentView.js" type="text/javascript"></script>
    </body>
</html>
