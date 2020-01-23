# mortgage
A mortgage calculator package, which exposes API for simple mortgage calculation.

# Usage
Exposes the following POST API for mortgage calculation and amoritization.

Route::post('/mortgage', 'MortgageController@mortgage');
Route::post('/amortization', 'MortgageController@amortization');
Route::post('/personalized-report', 'MortgageController@report');

# Mortgage

Calculate the mortgage for the given model.

Request body:
{
  "loanAmount":<number>,   //principal
  "rpa":<number>,          //Rate per annum
  "loanTerm":<number>,     //Terms in years
  "extraAmount"?:<number>, // Monthly extra amount (optional)
  "downPayment"?:<number>  //Initial Down Payment (optional)
}
  
  
# Amortization

Calculate the amortization schedule for the given model

Request body:
{
  "loanAmount":<number>,   //principal
  "rpa":<number>,          //Rate per annum
  "loanTerm":<number>,     //Terms in years
  "extraAmount"?:<number>, // Monthly extra amount (optional)
  "downPayment"?:<number>  //Initial Down Payment (optional)
}
  
  
# Report

Calculate the amortization schedule for the given model and email it to logged in user.

Request body:
{
  "loanAmount":<number>,   //principal
  "rpa":<number>,          //Rate per annum
  "loanTerm":<number>,     //Terms in years
  "extraAmount"?:<number>, // Monthly extra amount (optional)
  "downPayment"?:<number>  //Initial Down Payment (optional)
}
