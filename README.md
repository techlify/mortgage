# Mortgage
A mortgage calculator package, which exposes API for simple mortgage calculation.

# Installation
-> composer require joshbrw/laravel-module-installer
-> composer require techlify/mortgage-module

# Usage
Exposes the following POST API for mortgage calculation and amoritization.

Route::post('/mortgage', 'MortgageController@mortgage');
Route::post('/amortization', 'MortgageController@amortization');
Route::post('/personalized-report', 'MortgageController@report');

# Mortgage

Calculate the mortgage for the given model.

Request body:
{
  "loanAmount":number,   
  "rpa":number,          
  "loanTerm":number,     
  "extraAmount"?:number, 
  "downPayment"?:number  
}
  
  
# Amortization

Calculate the amortization schedule for the given model

Request body:
{
  "loanAmount":number,   
  "rpa":number,          
  "loanTerm":number,     
  "extraAmount"?:number, 
  "downPayment"?:number  
}
  
  
# Report

Calculate the amortization schedule for the given model and email it to logged in user.

Request body:
{
  "loanAmount":number,   
  "rpa":number,          
  "loanTerm":number,     
  "extraAmount"?:number, 
  "downPayment"?:number  
}
