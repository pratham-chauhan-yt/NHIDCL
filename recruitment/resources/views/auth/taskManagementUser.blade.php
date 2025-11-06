@extends('layouts.auth')
@section('auth_content')


                     <div class="form_bg_inner md:block hidden">
                     </div>
                        <div class="bg_form_">
                            <h1 class="heding_style ">
                                Login
                            </h1>
                            <form class="inpus_cust_cs " action="#">
                                <div class="">
                                    <label for="role" class="">Select Your Role</label>
                                    <select id="role" class="">
                                        <option value="./login.html">Technical Director</option>
                                        <option value="../hr/login.html">Executive Director</option>
                                        <option value="../hr/login.html">Managing Director</option>
                                        <option value="../hr/login.html">Task Creator</option>
                                        <option value="../hr/login.html">Reporting Officer(RO)</option>
                                        <option value="../hr/login.html">Direct reporting officer(DRO)</option>
                                        <option value="../hr/login.html">GMs</option>
                                        <option value="../hr/login.html">DGMs</option>
                                    </select>
                                </div>
                                <div class="relative  items-center">
                                    <label class="block">Employee ID</label>
                                    <input type="email" class="w-full" placeholder="Employee ID">
                                </div>
                                <div class="relative  items-center">
                                    <label class="block">Password</label>
                                    <input type="password" placeholder="••••••••"
                                        class="w-full" >
                                </div>
                                <div class="">
                                    <label class="block">Capture</label>
                                    <div class="flex items-center gap-4">
                                        <div class="captur">
                                            <img class="border p-2" src="{{asset('/images/capture.png')}}" alt="capture">
                                        </div>
                                        <div class="refresh">
                                            <img class="cursor-pointer" src="{{asset('/images/refresh.png')}}" alt="refresh">
                                        </div>
                                        <div class="input_f">
                                            <input type="text" placeholder="Verification Code" class="">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between pt-2">
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5 inpus_cust_cs">
                                            <input id="remember" aria-describedby="remember" type="checkbox"
                                                class="w-4 h-4" required="">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="remember"
                                                class="text-gray-500 dark:text-gray-600 cursor-pointer">Remember
                                                me</label>
                                        </div>
                                    </div>
                                    <a href="#" class="forgot_pads_cust">Forgot
                                        password?</a>
                                </div>

                                   <!-- <button type="submit" class="fill_btn hover-effect-btn">Log in </button> -->

                                <a href="{{route('task-management.index')}}" class="fill_btn hover-effect-btn" style="text-align:center;">Log in</a>

                                <button type="submit" onclick="window.location.href='./registration.html';"
                                    class="gray_btn hover-effect-btn bg-[#AEAAA6]">Registration
                                </button>

                            </form>
                        </div>  

@endsection                     

    