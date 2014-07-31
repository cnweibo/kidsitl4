								
								    <li class="inlineblock guestaddword" ng-repeat="wordadded in wordsadded"><span class="label label-default label-sm wordaddlabel"><small ng-bind="wordadded.wordtext"></small></span></li>
									<form style="display:inline" class="form-inline" ng-submit="addword()">
									    <span style="display:inline-block">
									    	<input type="text" name="wordadded" id="inputWordadded" class="guestaddwordinput" ng-model="newwordadded">
											<button type="submit" class="btn btn-info btn-xs">我来加词</button>
										</span>
									</form>					
							