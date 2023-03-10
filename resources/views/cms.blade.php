@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="mt-5">Privacy and Cookies Policy</h1>

        <div class="row">
            <div class="col-sm-3 mt-5">
                <ul class="nav flex-column nav-pills" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#introduction" role="tab">Introduction</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#use-cookies" role="tab">How does use
                            cookies?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#manage-cookies" role="tab">How to manage your
                            cookie preferences?</a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-9">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="introduction" role="tabpanel">
                        <h3 class="mt-5">Introduction</h3>
                        <p class="mt-3">Lorem ipsum dolor, sit amet consectetur adipisicing elit. A cupiditate cum, in eveniet iure
                            expedita distinctio est, quidem nobis similique eaque blanditiis! Praesentium nihil adipisci
                            aspernatur vero veritatis iste vitae!
                            Deserunt eligendi doloremque voluptatem quibusdam debitis aliquid ipsum ea facilis, est, unde
                            blanditiis! Cupiditate fuga et eligendi quis dignissimos, sunt saepe! Magnam dolorem autem eum,
                            hic mollitia adipisci nam fugit?</p>
                           <p> Ut ad eos minima qui ab magni reiciendis omnis laudantium eveniet possimus provident, pariatur
                            enim excepturi voluptatum inventore repudiandae distinctio magnam nemo sunt expedita veniam
                            totam, atque dolore perferendis. Consectetur!
                            Deleniti odio, quaerat eligendi, eos ipsam quo blanditiis laboriosam dolores nulla sunt, fuga
                            tempore magnam beatae quod vero distinctio in dolore doloremque! Molestiae assumenda blanditiis
                            ab cumque porro odit quibusdam.</p>
                            <p>Aliquam incidunt magnam officia temporibus alias dolor odit doloremque nobis, quidem perferendis
                            voluptatum ipsum maiores rerum in blanditiis numquam dolores? Ullam consequuntur, distinctio
                            ipsa voluptatem minus cum odit illo esse?</p>
                        <h3 class="mt-5">How does use cookies?</h3>
                        <p class="mt-3">Websites use cookies to personalize the user experience and to track user behavior. Cookies can
                            be used to remember a user's preferences, such as language settings or preferred layout. They
                            can also be used for targeted advertising, which shows users ads based on their browsing
                            history.</p>
                        <h3 class="mt-5">How to manage your cookie preferences?</h3>
                        <p class="mt-3">Users can manage their cookie preferences through their web browser settings. Most web browsers
                            allow users to control which cookies are allowed or blocked, delete cookies, and set preferences
                            for specific websites. Users can also use third-party tools, such as browser extensions, to
                            manage their cookie preferences.</p>
                    </div>

                    {{-- <div class="tab-pane fade" id="use-cookies" role="tabpanel">
                        <h3>How does use cookies?</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit optio temporibus eveniet eos. Ea
                            deserunt reprehenderit rerum inventore, ipsa consequuntur. Sint expedita, magnam facere
                            exercitationem libero deleniti ab rem optio.Beatae ducimus delectus itaque est nemo,
                            reprehenderit inventore dolore voluptas dolor velit sed accusantium voluptate dolorum fuga saepe
                            officiis amet sunt. Soluta, rerum quasi dolore quaerat dolorem nostrum earum sint.</p>
                    </div>

                    <div class="tab-pane fade" id="manage-cookies" role="tabpanel">
                        <h3>How to manage your cookie preferences?</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt voluptate ut alias cumque dolor,
                            illum consequatur, numquam consequuntur voluptas repudiandae enim nesciunt, soluta rem
                            exercitationem eaque laboriosam dolores accusantium maiores!Sunt nemo voluptate cum
                            reprehenderit harum commodi, non, esse minima dolor, quos delectus nulla pariatur error. Ipsam
                            explicabo animi, eaque beatae, exercitationem architecto nemo accusamus dolore, dignissimos
                            magnam repellendus facilis.</p>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
