<div>
    'Success is as dangerous as failure.' <br><br>


<div class="container">
    <div class="row">
        <div class="col-sm">
        <h4>Selected field: {{ $selectedField }}</h4>
        Select a field:
        <select wire:model.live='selectedField'>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select>
        </div>  
        <div class="col-sm">
            <button class="btn btn-success" style="display: inline" wire:click='createNewField()'>Create new field</button>
            <input type="text" class="form-control" style="display: inline; width: 350px" placeholder="Type here new field name" wire:model.live='newFieldName'>
        </div> 
    </div>
</div><hr><br>

<div class="container">
    <div class="row">
        <div class="col-sm">
            <div class="row">
                <div class="col-sm">
                    <div style="display: grid;
                    grid-template-columns: repeat(3, 1fr);
                    grid-template-rows: repeat(3, 1fr);
                    grid-column-gap: 0px;
                    grid-row-gap: 0px;">
                        <div style="grid-area: 1 / 1 / 2 / 2;"></div>
                        <div style="grid-area: 1 / 2 / 2 / 3;">
                            <button class="btn btn-dark" style="width: 80px">UP</button>
                        </div>
                        <div style="grid-area: 1 / 3 / 2 / 4;"></div>
                        <div style="grid-area: 2 / 1 / 3 / 2;">
                            <button class="btn btn-dark" style="width: 80px">LEFT</button>
                        </div>
                        <div style="grid-area: 2 / 2 / 3 / 3;"></div>
                        <div style="grid-area: 2 / 3 / 3 / 4;">
                            <button class="btn btn-dark" style="width: 80px">RIGHT</button>
                        </div>
                        <div style="grid-area: 3 / 1 / 4 / 2;"></div>
                        <div style="grid-area: 3 / 2 / 4 / 3;">
                            <button class="btn btn-dark" style="width: 80px">DOWN</button>
                        </div>
                        <div style="grid-area: 3 / 3 / 4 / 4;"></div>
                    </div>
                </div>
                <div class="col-sm">
                    <h5>Select move increments:</h5><hr>
                    <select wire:model.live='moveIncre'>
                        <option value="0" disabled>Move increments</option>
                        <option value="1">1px</option>
                        <option value="5">5px</option>
                        <option value="10">10px</option>
                        <option value="50">50px</option>
                        <option value="100">100px</option>
                    </select><br>
                    Current increments: {{ $moveIncre }}px
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm ">
                    <h6>Basic info: </h6>
                    <p>
                        TOP:    100px <br> 
                        LEFT:   100px                
                    </p>
                    <label for="">Next field id: </label>
                    <input type="text" class="form-control form-control-sm" style="display: inline; width: 150px"><br><br>
                    <button class="btn btn-success ">SAVE</button>
                </div>
            </div>
        </div>  
        <div class="col-sm" style="background-color: rgb(187, 255, 0)">
            test
        </div> 
    </div>
</div>



</div>
