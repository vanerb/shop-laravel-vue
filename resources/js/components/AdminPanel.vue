<template>
    <div class="container">
        <div class="row mt-4">

            <div class="col-md-4 ">
                <div class="card">
                    <div class="card-header">
                        <h1>Administración productos</h1>
                    </div>
                    <div class="card-body">
                        <router-link type="button" to="showproduct" class="btn btn-success w-100">Ir</router-link>
                    </div>

                </div>
                
               
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h1>Administración categorias</h1>
                    </div>
                    <div class="card-body">
                         <router-link type="button" to="showcategory" class="btn btn-success w-100">Ir</router-link>
                    </div>
                </div>
               
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h1>Administración usuarios</h1>
                    </div>
                    <div class="card-body">
                         <router-link type="button" to="showuser" class="btn btn-success w-100">Ir</router-link>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</template>