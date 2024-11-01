 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="table-container">
                    <div class="table-responsive">
                        <table id="copy-print-csv" class="table custom-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>customer Name</th>
                                    <th>customer_address</th>
                                    <th>landmark</th>
                                    <th>contact_number</th>
                                    <th>alternate_number</th>
                                    <th>email</th>
                                    <th>service</th>
                                    <th>sub_service</th>
                                    <th>comments</th>
                                    <th>status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leads as $lead)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $lead->customer_name }}</td>
                                        <td>{{ $lead->customer_address }}</td>
                                        <td>{{ $lead->landmark }}</td>
                                        <td>{{ $lead->contact_number }}</td>
                                        <td>{{ $lead->alternate_number }}</td>
                                        <td>{{ $lead->email }}</td>
                                        <td>{{ $lead->service }}</td>
                                        <td>{{ $lead->sub_service }}</td>
                                        <td>{{ $lead->comments }}</td>
                                        <td>{{ $lead->status }}</td>

                                        <td>
                                            @if(auth()->user()->type=='admin' || auth()->user()->type=='branch')
                                            <button type="button" class="btn btn-primary btn-block mb-2" data-toggle="modal"
                                                data-target="#edit{{ $lead->id }}">Edit</button>
                                                <a href=""><button type="button" class="btn btn-primary btn-block">button</button></a>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
