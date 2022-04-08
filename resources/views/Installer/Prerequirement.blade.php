@extends('Installer.Installerlayouts')
@section('title','Installer')
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-4 bg-light rounded text-center requirement-container">
          <div class="hr-line"></div>
          <div class="installer-menu">
              <span class="bg-primary p-1"><i class="bi bi-house-fill"></i></span>
              <span class="bg-primary p-1"><i class="bi bi-hdd-rack-fill"></i></span>
              <span class="bg-secondary p-1"><i class="bi bi-key-fill"></i></span>
              <span class="bg-secondary p-1"><i class="bi bi-server"></i></span>
              <span class="bg-secondary p-1"><i class="bi bi-gear-wide-connected"></i></span>
          </div>
            <p class="card-title fw-bold">Server Requirements</p>
            <div class="card-body">
                <table class="table border">
                    <tbody>
                      <tr class="bg-secondary">
                        <td class="fw-bold">PHP <small>(version 8.0 required)</small></td>
                        @if($requirements[0]>='8.0')
                        <td class="text-center"><i class="bi bi-check-circle-fill text-info"></i></td>
                        @else
                        <td class="text-center"><i class="bi bi-x-circle-fill text-danger"></i></td>
                        @endif
                      </tr>
                      <tr>
                        <td>BCMath</td>
                        @if($requirements[1] == 1)
                        <td class="text-center"><i class="bi bi-check-circle-fill text-info"></i></td>
                        @else
                        <td class="text-center"><i class="bi bi-x-circle-fill text-danger"></i></td>
                        @endif
                      </tr>
                      <tr>
                        <td>Ctype</td>
                        @if($requirements[2] == 1)
                        <td class="text-center"><i class="bi bi-check-circle-fill text-info"></i></td>
                        @else
                        <td class="text-center"><i class="bi bi-x-circle-fill text-danger"></i></td>
                        @endif
                      </tr>
                      <tr>
                        <td>cURL</td>
                        @if($requirements[3] == 1)
                        <td class="text-center"><i class="bi bi-check-circle-fill text-info"></i></td>
                        @else
                        <td class="text-center"><i class="bi bi-x-circle-fill text-danger"></i></td>
                        @endif
                      </tr>
                      <tr>
                        <td>DOM</td>
                        @if($requirements[4] == 1)
                        <td class="text-center"><i class="bi bi-check-circle-fill text-info"></i></td>
                        @else
                        <td class="text-center"><i class="bi bi-x-circle-fill text-danger"></i></td>
                        @endif
                      </tr>
                      <tr>
                        <td>Fileinfo</td>
                        @if($requirements[5] == 1)
                        <td class="text-center"><i class="bi bi-check-circle-fill text-info"></i></td>
                        @else
                        <td class="text-center"><i class="bi bi-x-circle-fill text-danger"></i></td>
                        @endif
                      </tr>
                      <tr>
                        <td>JSON</td>
                        @if($requirements[6] == 1)
                        <td class="text-center"><i class="bi bi-check-circle-fill text-info"></i></td>
                        @else
                        <td class="text-center"><i class="bi bi-x-circle-fill text-danger"></i></td>
                        @endif
                      </tr>
                      <tr>
                        <td>Mbstring</td>
                        @if($requirements[7] == 1)
                        <td class="text-center"><i class="bi bi-check-circle-fill text-info"></i></td>
                        @else
                        <td class="text-center"><i class="bi bi-x-circle-fill text-danger"></i></td>
                        @endif
                      </tr>
                      <tr>
                        <td>OpenSSL</td>
                        @if($requirements[8] == 1)
                        <td class="text-center"><i class="bi bi-check-circle-fill text-info"></i></td>
                        @else
                        <td class="text-center"><i class="bi bi-x-circle-fill text-danger"></i></td>
                        @endif
                      </tr>
                      <tr>
                        <td>PCRE</td>
                        @if($requirements[9] == 1)
                        <td class="text-center"><i class="bi bi-check-circle-fill text-info"></i></td>
                        @else
                        <td class="text-center"><i class="bi bi-x-circle-fill text-danger"></i></td>
                        @endif
                      </tr>
                      <tr>
                        <td>PDO</td>
                        @if($requirements[10] == 1)
                        <td class="text-center"><i class="bi bi-check-circle-fill text-info"></i></td>
                        @else
                        <td class="text-center"><i class="bi bi-x-circle-fill text-danger"></i></td>
                        @endif
                      </tr>
                      <tr>
                        <td>Tokenizer</td>
                        @if($requirements[11] == 1)
                        <td class="text-center"><i class="bi bi-check-circle-fill text-info"></i></td>
                        @else
                        <td class="text-center"><i class="bi bi-x-circle-fill text-danger"></i></td>
                        @endif
                      </tr>
                      <tr>
                        <td>XML</td>
                        @if($requirements[12] == 1)
                        <td class="text-center"><i class="bi bi-check-circle-fill text-info"></i></td>
                        @else
                        <td class="text-center"><i class="bi bi-x-circle-fill text-danger"></i></td>
                        @endif
                      </tr>
                    </tbody>
                  </table>
                  @if($nextSteps == true)
                  <a href="{{ route('installer.environment') }}" class="btn btn-primary rounded">Environment Setup<i class="bi bi-caret-right-fill"></i></a>
                  @else
                  <button class="btn btn-danger btn-lg" disabled>Does not meet minimum requirements</button>
                  @endif
            </div>
        </div>
    </div>
</div>