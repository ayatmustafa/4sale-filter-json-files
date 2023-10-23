
# About The Task

We have two providers collect data from them in json files we need to read and make some filter operations on them to get the result

- DataProviderX data is stored in [DataProviderX.json].
- DataProviderY data is stored in [DataProviderY.json].

**DataProviderX schema is**
```json
 { 
    parentAmount:200,
    Currency:'USD', 
    parentEmail:'parent1@parent.eu', 
    statusCode:1, 
    registerationDate: '2018-11-30', 
    parentIdentification: 'd3d29d70-1d25-11e3-8591-034165a3a613' 
}
```
 we have three status for DataProviderX 
*   authorised which will have statusCode 1 
*   decline which will have statusCode 2 
*   refunded which will have statusCode 3

**DataProviderY schema is**
```json
 { 
    balance:300, 
    currency:'AED', 
    email:'parent2@parent.eu', 
    status:100, created_at: '22/12/2018', 
    id: '4fc2-a8d1' 
}
```

we have three status for DataProviderY
*  authorised which will have statusCode 100
*  decline which will have statusCode 200
*  refunded which will have statusCode 300

# **Acceptance Criteria**
Using PHP Laravel, implement this API endpoint
* it should list all users which combine transactions from all the available
  (providerDataProviderX and DataProviderY )
* it should be able to filter result by payment providers for example /api/
v1/users?provider=DataProviderX it should return users from
DataProviderX
* it should be able to filter result three statusCode
(authorised, decline, refunded) for example /api/v1/users?
statusCode=authorised it should return all users from all providers that
have status code authorised
* it should be able to filer by amount range for example /api/v1/users?
balanceMin=10&balanceMax=100 it should return result between 10 and
100 including 10 and 100
* it should be able to filer by currency
* it should be able to combine all this filter together

## The Evaluation

Task will be evaluated based on
1. Code quality
2. Application performance in reading large files
3. Code scalability : ability to add DataProviderZ by small changes
4. Unit tests coverage
5. Docker


# Technical Points

### 1. Postman Collection
you can import postman collection
https://api.postman.com/collections/9536988-7d9ce391-9654-4e39-819b-f0d477dd6746?access_key=PMAT-01HDF3DZRPBMER88A12FADJRG2
### 2. How to add any other data provider (DataProviderZ)
1. add json file for this provider in storage/dataProviders
2. add it's name.json in ProvidesEnum

    #### ex :
    
    public const DataProviderZ = "DataProviderZ.json";
    constant DataProviderZ Should be the file name DataProviderZ and should be without any spaces
3. add service  like DataProviderYService which added in namespace App\Services\DataProviders 

    #### ex :
    for DataProviderZService it should named with the name of jsonFile and add extend from DataProviderAbstract

##### and implement in it the **two abstract functions**

* #####   1. filterByKey:
which have all fields that in the json file and mapping it into request enumerator
* #####   2. GetStatusValue:
which have all needed status and it's code in current provider 

### 3. What We Need to Run The Task
we need to have php8 <
and have docker engin

### 3. How to Run The Task
* Clone the project
* cd **projectName**
* ./vendor/bin/sail up



