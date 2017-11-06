
            {{ Form::open(array('url' => 'search_id_date', 'method' => 'post','class'=> 'form-horizontal', 'role'=>'form'))  }}
            @include('errors.error')
            <div class="form-body">
                @include('flash::message')
                <div class="form-group">
                    <label class="col-md-2 control-label">TB</label>
                    <div class="col-md-6">
                        <input type="name" name="tb" class="form-control" placeholder="Enter TB">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">From</label>
                    <div class="col-md-6">
                        <input type="date" name="from" class="form-control" ></input>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">To</label>
                    <div class="col-md-6">
                        <input type="date" name="to" value="" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-4 pull-right">
                        <button type="submit" class="btn green">Search</button>
                    </div>

                </div>
                {{ Form::close() }}
