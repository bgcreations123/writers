<nav class="col-md-2 d-none d-md-block bg-light sidebar border-right">
  <div class="sidebar-sticky">
    <ul class="nav flex-column">
      @if(auth()->user()->hasRole('Writer'))
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('home') }}">
            <span class="fa fa-home"></span>
            Dashboard <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('writer.jobs') }}">
            <span class="fa fa-archive"></span>
            Job Pool
          </a>
        </li>
        <li class="nav-item">
          <a href="#jobsSubmenu" data-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle collapsed">
            <span class="fa fa-clone"></span>
            My Jobs
          </a>
          <ul class="list-unstyled collapse ml-4" id="jobsSubmenu" style="">
              <li>
                <a href="{{ route('writer.my_jobs', ['id' => auth()->user()->id]) }}" class="nav-link">
                  <span class="fa fa-cogs"></span>
                  In Process
                </a>
              </li>
              <li>
                <a href="{{ route('writer.deffered_jobs') }}" class="nav-link">
                  <span class="fa fa-ban"></span>
                  Deffered
                </a>
              </li>
              <li>
                <a href="{{ route('writer.completed_jobs') }}" class="nav-link">
                  <span class="fa fa-check-square-o"></span>
                  Completed
                </a>
              </li>
          </ul>
        </li>
        @endif
        @if(auth()->user()->hasRole('Client') || auth()->user()->hasRole('Writer') )
          <li class="nav-item">
            <a href="#paymentsSubmenu" data-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle collapsed">
              <span class="fa fa-money"></span>
              Payments
            </a>
            <ul class="list-unstyled collapse ml-4" id="paymentsSubmenu" style="">
                <li>
                  <a href="{{ route('writer.my_account') }}" class="nav-link">
                    <span class="fa fa-ravelry"></span>
                    My Account
                  </a>
                </li>
                <li>
                  <a href="{{ route('writer.payments') }}" class="nav-link">
                    <span class="fa fa-thumbs-o-up"></span>
                    Paid dues
                  </a>
                </li>
                <li>
                  <a href="{{ route('writer.unpaid') }}" class="nav-link">
                    <span class="fa fa-thumbs-o-down"></span>
                    Unpaid dues
                  </a>
                </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#messageSubmenu" data-toggle="collapse" aria-expanded="false" class="nav-link dropdown-toggle collapsed">
              <span class="fa fa-envelope"></span>
              Messages
            </a>
            <ul class="list-unstyled collapse ml-4" id="messageSubmenu" style="">
                <!-- <li>
                  <a href="#" class="nav-link">
                    <span class="fa fa-paper-plane-o"></span>
                    Compose
                  </a>
                </li> -->
                <li>
                  <a href="{{ route('messages.inbox') }}" class="nav-link">
                    <span class="fa fa-envelope-open-o"></span>
                    Inbox
                  </a>
                </li>
                <li>
                  <a href="{{ route('messages.sent') }}" class="nav-link">
                    <span class="fa fa-mail-forward"></span>
                    Sent
                  </a>
                </li>
            </ul>
          </li>
        @endif
        @if(auth()->user()->hasRole('Writer'))
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span class="fa fa-chart-bar"></span>
            Reports
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <span class="fa fa-question-circle"></span>
            Help
          </a>
        </li>
      @endif
    </ul>

    @if(auth()->user()->hasRole('Writer'))

      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>More reports</span>
        <a class="d-flex align-items-center text-muted" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
        </a>
      </h6>
      <ul class="nav flex-column mb-2">
        <li class="nav-item">
          <a class="nav-link" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
            Current month
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
            Last quarter
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
            Social engagement
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
            Year-end income
          </a>
        </li>
      </ul>
    @endif
  </div>
</nav>