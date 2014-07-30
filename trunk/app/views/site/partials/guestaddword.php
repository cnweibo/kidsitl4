								
								    <li class="inlineblock guestaddword" ng-repeat="wordadded in wordsadded">{{wordadded.wordtext}}</li>
									<form class="form-inline" ng-submit="addword()">
									    <input type="text" name="wordadded" id="inputWordadded" class="form-control" ng-model="newwordadded">
										<p>发音规则id:{{fayinguizeid<?php echo $fayinguize->id?>}}</p>
										<button type="submit" class="btn btn-info">我来加词</button>
									</form>					
							