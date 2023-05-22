<template>
  <ion-content color="light" :class="step<=5 ? 'ion-padding' : 'no-padding'" :fullscreen="true">


  <span v-if="step==1" class="ion-text-center content-span">

    <h3 class="love-image " style="font-family: cursive; font-weight: bolder">Congratulations On your wedding <br> {{
        $store.state.user.first_name
      }}</h3>

    <svg class="love-image" data-name="Layer 1" height="506.49355" style="height: 200px; width: 70%"
         viewBox="0 0 684.76331 506.49355" width="684.76331" xmlns="http://www.w3.org/2000/svg"
         xmlns:xlink="http://www.w3.org/1999/xlink"><polygon
        fill="#9e616a" points="140.266 494.709 150.838 494.708 155.867 453.933 140.264 453.934 140.266 494.709"/><path
        d="M395.18793,688.01066l2.97556-.00012,11.617-4.72438,6.22639,4.72366h.00084a13.2682,13.2682,0,0,1,13.26749,13.26728v.43114l-34.08669.00126Z"
        fill="#2f2e41" transform="translate(-257.61835 -196.75322)"/><polygon
        fill="#9e616a" points="189.379 494.709 199.951 494.708 204.98 453.933 189.377 453.934 189.379 494.709"/><path
        d="M444.30085,688.01066l2.97556-.00012,11.617-4.72438,6.22639,4.72366h.00084a13.2682,13.2682,0,0,1,13.26749,13.26728v.43114l-34.08669.00126Z"
        fill="#2f2e41" transform="translate(-257.61835 -196.75322)"/><path
        d="M455.44764,468.31824,372.389,470.485l1.4445,40.44594s-1.4445,10.83373,1.4445,13.72273,4.33349,2.889,2.889,7.94474,6.18746,13.31326,5.26048,14.24024-3.09373,5.98272-3.09373,5.98272l7.22249,41.16819s5.05574,71.50263,6.50024,72.94713,2.889,0,1.44449,3.61124-2.889,2.16675-1.44449,3.61125a53.19561,53.19561,0,0,1,3.61124,4.33349h17.46193s1.31654-7.22249,1.31654-7.94474,1.4445-5.05574,1.4445-5.778-1.27673-1.999-1.27673-1.999a23.76122,23.76122,0,0,1-.89-4.50126c0-1.44449-4.33349-57.05765-4.33349-57.05765l8.667-72.22489,20.94521,70.78039s0,62.1134,1.4445,63.5579,1.4445.72225.72225,3.61124-3.61125,2.16675-1.4445,4.33349,2.889-1.44449,2.16675,2.16675l-.72225,3.61124,21.66746.31s2.889-6.08794,1.4445-8.25468-1.35783-1.5753.40446-5.12115,2.48454-4.26809,1.76229-4.99034-.72225-4.56381-.72225-4.56381l-3.61125-69.10557s-.72224-72.94713-.72224-75.11388a7.20412,7.20412,0,0,1,.6-3.24922v-2.94108L461.22563,493.597Z"
        fill="#2f2e41" transform="translate(-257.61835 -196.75322)"/><path
        d="M549.4444,310.79389a8.0652,8.0652,0,0,1-11.60959,4.2615l-36.05395,30.20512-1.9594-14.76429,35.26391-26.99494a8.1089,8.1089,0,0,1,14.359,7.29261Z"
        fill="#9e616a" transform="translate(-257.61835 -196.75322)"/><circle cx="132.8478" cy="104.11708" fill="#9e616a"
                                                                             r="22.38971"/><path
        d="M408.61743,278.58776c-2.08444-4.9682-11.01748-7.918-25.15293-7.47373s-16.61088,17.301-16.61088,17.301c-7.7858,7.25682,4.78422,29.91414,6.965,26.79029,2.18079-3.1238,5.84226-.17107,5.84226-.17107l-3.48932-19.62672c3.68483,1.41759,7.6478,2.36941,11.11371.71789l-5.74252-3.07069q7.13905.88837,14.27815,1.77675l-5.88836-4.53c.14274-.04713.28548-.09609.4283-.14415a20.92492,20.92492,0,0,0,7.45992,1.6937c3.002-.02239,6.19233-1.42914,7.4503-4.155a6.13852,6.13852,0,0,0,.53276-2.3761c4.13922,1.34387,6.31262,6.19288,6.31262,6.19288A76.403,76.403,0,0,0,408.61743,278.58776Z"
        fill="#2f2e41" transform="translate(-257.61835 -196.75322)"/><path
        d="M408.38817,324.26143c-5,0-8.22.69-16,2-14.36,2.42-5.76,16.06452-5.76,16.06452s.65-.33-1.11,0-7.76,5.52-7.76,5.52l-10.73,9.53c-16.17,12.69-12.55,32.49-12.55,32.49l23.58,23.73-10.33,47.61s4.38995,7.07,2.11993,10.24,20,2.26,20,2.26c15.37,6.85,69.52,1.06,69.52,1.06-.75-1.96-8-17.15-8-17.15,3.15-5.44.15-13.3.15-13.3s-3.13-37.18006-5.13-42.32,5.12-32.99,9.8-32.69,34.91-15.12,34.91-15.12-.76-1.21,9.22-5.29a48.91145,48.91145,0,0,0,15.49-9.77l4.1-8.19c-1.97.76-8.62-11.78-8.62-11.78l-2.9,1.1055-1.68006-.4855s-13.11,3.73-15.79,6.45-3.58,1.96-6,2.57-2.72,2.31-3.48,2.12-2.11,2.11-3.17,1.81-3.33.91-4.84,1.21-12.24,4.84-12.24,4.84c-6.64-3.36-24.64-2-24.64-2s-5.89-3.47-7.56,0a5.68995,5.68995,0,0,1-5.13,3.33l-7.18-3.07C416.26085,338.5591,408.42918,322.68263,408.38817,324.26143Z"
        fill="#2fb1af" transform="translate(-257.61835 -196.75322)"/><path
        d="M374.10876,510.59463a8.06519,8.06519,0,0,1,1.80006-12.2353L365.7364,458.37089l13.90766,5.32924,7.72924,37.76127a8.1089,8.1089,0,0,1-13.26454,9.13323Z"
        fill="#9e616a" transform="translate(-257.61835 -196.75322)"/><path
        d="M355.38817,382.26143l-1.25622,15.9685s-1.56154,17.54331-1.15266,20.7874,1.17031,23.05512,1.17031,23.05512l13.23857,26.189,15-4-.89764-12.28549.89764,11.28549,2-10-5-17,3-6-1.51287-20.14116Z"
        fill="#2fb1af" transform="translate(-257.61835 -196.75322)"/><path
        d="M710.52922,344.94078l4.95224,1.06121a28.50966,28.50966,0,0,1,.76987-6.1487,18.46361,18.46361,0,0,0,2.78828,6.90816l28.40245,6.06545,27.2684-28.777c.04166-14.38846-7.94848-25.32289-22.27457-25.32289-.86354,0-1.75825.04159-2.66338.12484A30.299,30.299,0,0,0,715.0861,322.6662C704.932,332.66427,708.615,338.5424,710.52922,344.94078Z"
        fill="#2f2e41" transform="translate(-257.61835 -196.75322)"/><polygon
        fill="#ffb6b6" points="438.947 484.723 428.645 484.723 423.744 444.985 438.949 444.985 438.947 484.723"/><path
        d="M701.17424,701.03875h-7.31052l-1.3049-6.902-3.342,6.902H669.82754a4.35853,4.35853,0,0,1-2.47666-7.94519L682.83456,682.4v-6.97769l16.28613.97206Z"
        fill="#2f2e41" transform="translate(-257.61835 -196.75322)"/><polygon
        fill="#ffb6b6" points="559.646 473.509 550.685 478.593 526.812 446.449 540.037 438.946 559.646 473.509"/><path
        d="M830.92673,685.0023,824.56841,688.61l-4.541-5.35905.49936,7.65228L803.663,700.4717a4.35852,4.35852,0,0,1-6.075-5.68811l8.1897-16.94184-3.44345-6.06884,14.64457-7.19165Z"
        fill="#2f2e41" transform="translate(-257.61835 -196.75322)"/><path
        d="M658.484,351.90278a9.12421,9.12421,0,0,1,7.35419,11.90215l15.7652,13.64545-5.95565,11.60294-21.99286-19.58271a9.17367,9.17367,0,0,1,4.82912-17.56783Z"
        fill="#ffb6b6" transform="translate(-257.61835 -196.75322)"/><path
        d="M672.11159,394.37186l-10.5443-16.775,11.72412-11.98658,8.32651,10.132,10.31465,4.60188,14.15584,8.625c2.81463-3.313,24.505-28.23054,34.18306-21.056a9.74325,9.74325,0,0,1,4.196,6.983c.6838,6.67049-5.2947,13.45568-5.52165,13.70691l-12.785,17.24649c-.39713,1.08331-4.62782,12.25145-11.22887,15.25572a7.50669,7.50669,0,0,1-6.035.19721c-17.49221-6.81929-29.27829-14.51138-34.53712-22.47609A20.21593,20.21593,0,0,1,672.11159,394.37186Z"
        fill="#2f2e41" transform="translate(-257.61835 -196.75322)"/><path
        d="M711.12809,429.38423s-30.29263,48.25214-24.80452,53.74024,14.02832,6.92923,14.02832,6.92923l18.90033-24.49117Z"
        fill="#2f2e41" transform="translate(-257.61835 -196.75322)"/><path
        d="M737.91178,363.48373l-14.27709,9.658a36.82745,36.82745,0,0,0-14.348,42.01287l4.0194,12.217Z"
        fill="#2f2e41" transform="translate(-257.61835 -196.75322)"/><polygon
        fill="#2f2e41"
        points="505.539 298.445 507.448 305.093 513.961 385.264 546.501 445.908 530.97 457.001 486.597 399.316 469.047 342.038 441.484 468.834 420.777 467.355 435.158 291.554 462.449 242.071 505.539 298.445"/><path
        d="M740.33984,365.91232,720.469,382.15178a27.06166,27.06166,0,0,0-8.98333,13.83374v0a27.06206,27.06206,0,0,0-.94974,7.57473l.59212,35.26352L692.9093,487.515s49.393,18.65957,55.9787,2.19524S740.33984,365.91232,740.33984,365.91232Z"
        fill="#2fb1af" transform="translate(-257.61835 -196.75322)"/><path
        d="M712.66649,473.24588l-3.29287-13.17146.80418-32.7728c.06391-1.90428,10.2146-31.54226,23.00673-63.0237l11.0052-11.00473,5.93282-3.86082,13.05962,12.05474s-1.66054,32.99672-1.12272,66.77629c.14881,9.34584-1.49405,20.26062-2.19524,28.53816l6.0004,26.66224v14.84085l-.39031.07887c-.3896.07887-6.40306-.10681-31.07769-.10681C713.952,498.25671,727.56268,483.76123,712.66649,473.24588Z"
        fill="#2f2e41" transform="translate(-257.61835 -196.75322)"/><polygon
        opacity="0.2" points="500.028 194.141 503.029 212.864 482.721 221.241 500.028 194.141"/><circle cx="479.57187"
                                                                                                        cy="129.26486"
                                                                                                        fill="#ffb6b6"
                                                                                                        r="19.88195"/><path
        d="M770.50425,426.89681l0,0a36.52061,36.52061,0,0,1-43.8385,8.86091l-4.32724-2.14156Z"
        opacity="0.2" transform="translate(-257.61835 -196.75322)"/><path
        d="M701.31983,422.32007a9.12421,9.12421,0,0,1,13.98452.42232l20.07437-5.63557,6.40006,11.36386L713.31811,436.031a9.17367,9.17367,0,0,1-11.99828-13.711Z"
        fill="#ffb6b6" transform="translate(-257.61835 -196.75322)"/><path
        d="M744.26813,434.3524l-19.8087-.44567L720.91812,417.518l13.04323-1.36455,9.52425-6.07108,14.99811-7.05933c-1.21345-4.1744-10.05282-36.00553,1.26739-40.12767a9.74322,9.74322,0,0,1,8.13927.34684c5.943,3.10538,8.31033,11.83333,8.3949,12.16116L783.6311,395.576c.68512.92839,7.67294,10.61323,6.54216,17.77709a7.50673,7.50673,0,0,1-3.16121,5.1446c-15.33,10.83843-28.24374,16.43439-37.788,16.43344A20.21627,20.21627,0,0,1,744.26813,434.3524Z"
        fill="#2f2e41" transform="translate(-257.61835 -196.75322)"/><path
        d="M713.34868,312.93858c1.59182,2.07035,7.0746,3.90144,13.5874,5.37877-.01041-.1352-.01041-.27045-.01041-.40571a28.51028,28.51028,0,0,1,.76987-6.1487,18.46349,18.46349,0,0,0,2.78829,6.90816c.104.15609.208.31211.32251.46819,5.58685,1.1028,11.49622,1.95592,16.12594,2.52812-3.18357,11.465-15.38731,20.87009-14.066,27.84067l35.758,7.30344a28.03231,28.03231,0,0,1,.68663-8.63516A18.58683,18.58683,0,0,0,774.492,358.008l3.0379.6242.90513-4.46322c7.84447-18.84132-3.08991-38.13-21.00534-48.1073a21.777,21.777,0,0,0-13.79549-9.25944l-4.46322-.91554A21.88028,21.88028,0,0,0,713.34868,312.93858Z"
        fill="#2f2e41" transform="translate(-257.61835 -196.75322)"/><path
        d="M274.70863,676.84207l-.48174-10.83182a34.98315,34.98315,0,0,0-16.31744-4.13057c7.837,6.4073,6.8576,18.75841,12.17087,27.37474a21.04264,21.04264,0,0,0,15.43077,9.72408l6.55827,4.01542a35.26075,35.26075,0,0,0-7.43206-28.57312,34.06019,34.06019,0,0,0-6.25958-5.81618C276.807,672.7463,274.70863,676.84207,274.70863,676.84207Z"
        fill="#f2f2f2" transform="translate(-257.61835 -196.75322)"/><path
        d="M258.809,703.24678H941.191a1.19069,1.19069,0,0,0,0-2.38137H258.809a1.19069,1.19069,0,0,0,0,2.38137Z"
        fill="#cacaca" transform="translate(-257.61835 -196.75322)"/><path
        d="M628.99905,264.80718c2.47411,10.8697,3.65,23.19285-2.94906,32.92a22.60018,22.60018,0,0,1-11.69787,8.86176,33.19417,33.19417,0,0,1-14.9065.9156c-11.25543-1.55938-21.25864-7.42214-32.32809-9.69833-4.88493-1.00449-10.06918-1.33649-14.77168.59669-3.52347,1.44848-7.23465,4.36064-7.25156,8.51474-.01737,4.2658,3.6876,7.09707,7.37228,8.40863,4.91663,1.75007,10.02624,1.07273,15.12595.85214,5.49244-.23758,11.093.25908,15.65586,3.62276a27.22947,27.22947,0,0,1,8.70142,11.79727c2.29343,5.5661,3.22429,11.55034,4.69076,17.35773a77.07252,77.07252,0,0,0,5.53231,15.12563,78.3522,78.3522,0,0,0,19.14376,24.81466c3.93926,3.39016,8.72569,6.84394,14.10564,7.15467,4.14959.23966,9.19371-1.50406,10.79318-5.707a8.19475,8.19475,0,0,0-3.83658-9.72918c-3.55622-1.79454-7.42916.76542-8.57758,4.279a5.47726,5.47726,0,0,0,.57067,4.93908c1.07829,1.60788-1.51933,3.11129-2.59041,1.51415-2.48685-3.70823-1.187-8.69547,1.85866-11.66586a8.737,8.737,0,0,1,11.499-.857,11.36119,11.36119,0,0,1,4.1531,11.73953c-1.27929,4.6166-5.81562,7.5531-10.34564,8.2806-5.5941.89838-10.97782-1.30019-15.49346-4.47649a69.4528,69.4528,0,0,1-12.26916-11.333,81.43966,81.43966,0,0,1-16.24638-29.049c-3.30206-10.58121-3.54225-24.55935-13.354-31.70534-5.04883-3.67711-11.2352-3.26928-17.15486-2.93176-5.22555.298-10.32313.24379-15.117-2.12187-3.95837-1.95338-7.15208-5.55889-7.21812-10.15242-.06666-4.6372,3.22567-8.36592,7.10487-10.4786,10.24787-5.58119,22.55427-1.08,32.622,2.64874,10.12432,3.74972,21.68375,8.15073,32.4433,4.20478a20.12461,20.12461,0,0,0,11.11766-10.62283c2.60543-5.52533,2.97613-11.79462,2.37425-17.791a77.42736,77.42736,0,0,0-1.64958-9.43093c-.42785-1.87971,2.46384-2.68225,2.89284-.79751Z"
        fill="#3f3d56" transform="translate(-257.61835 -196.75322)"/><path
        d="M610.61062,234.31506a100.84349,100.84349,0,0,0,13.26,27.84q2.16,3.15,4.54,6.14a32.49279,32.49279,0,0,1,4.45-6.22c6.05-6.65,14.16-11,22.03-15.36,7.87-4.36,15.86-9.04,21.42-16.11a28.39923,28.39923,0,0,0,5.24-10.79c1.26-5.33.78-10.89-2.33-15.34-4.52-6.47-13.53-8.75-21.19-6.88-7.67,1.87-14.09,7.2-19.06994,13.32,1.62994-7.52-6.3-14.78-13.97-14.12-7.67.67-13.82,7.37-15.86,14.79C607.08065,218.99505,608.41061,226.93506,610.61062,234.31506Z"
        fill="#2fb1af" transform="translate(-257.61835 -196.75322)"/><g opacity="0.2"><path
        d="M623.87063,262.155q2.16,3.15,4.54,6.14a32.49279,32.49279,0,0,1,4.45-6.22c6.05-6.65,14.16-11,22.03-15.36,7.87-4.36,15.86-9.04,21.42-16.11a28.39923,28.39923,0,0,0,5.24-10.79,75.76561,75.76561,0,0,0-45.9,24.35A73.70884,73.70884,0,0,0,623.87063,262.155Z"
        transform="translate(-257.61835 -196.75322)"/></g></svg>
   <ion-button
       class="ion-margin-top"
       expand="block"
       mode="ios"
       shape="round"
       size="large"
       style="z-index: 999999 !important;"
       @click="start"
   >Create Registry<ion-icon :icon="arrowForwardOutline"></ion-icon></ion-button>
  </span>

    <weddin-welcom-animation v-if="step===1"></weddin-welcom-animation>


    <div v-if="step===2" class="ion-text-center smooth-in">
      <h1>Hello {{ $store.state.user.first_name }},</h1>
      <h2 class="font-weight-light">Are you the groom or the bride?</h2>

      <!--      <alert-component-->

      <!--          title="What does this mean?"-->
      <!--          description=" Depending on your choice, we would assume you are the the bride or groom<br>-->
      <!--      eg. If you say you are the bride then the only person we need to register is the groom and vise versa."-->
      <!--      ></alert-component>-->


      <ion-button class="ion-margin-top" expand="block"
                  fill="outline"
                  mode="ios"
                  shape="round"
                  size="large"
                  style="transition: 0.1s ease-in-out" @click="groosatusSeleted=true; userIsGroom=false; setUser()"
      >
        <ion-icon v-if="groosatusSeleted && !userIsGroom" :icon="checkmarkOutline"></ion-icon>
        I am the bride
        <ion-icon :icon="femaleOutline"></ion-icon>

      </ion-button>

      <ion-button class="ion-margin-top" expand="block"
                  fill="outline" mode="ios"
                  shape="round"
                  size="large"
                  style="transition: 0.1s ease-in-out" @click="groosatusSeleted=true; userIsGroom=true; setUser()">
        <ion-icon v-if="groosatusSeleted && userIsGroom" :icon="checkmarkOutline"></ion-icon>

        I am the groom

        <ion-icon :icon="maleOutline"></ion-icon>

      </ion-button>

    </div>


    <div v-if="step==3" class="smooth-in">

      <center>
        <ion-avatar>
          <img :src="avatarUrl">
        </ion-avatar>
      </center>

      <h4 class="ion-text-center ion-margin-top">{{ userIsGroom ? "Bride's " : "Groom's " }} Information</h4>


      <ion-list style="background-color: transparent !important;" v-if="userIsGroom" class="ion-margin-top">

        <ion-item lines="none" color="light">
          <ion-input v-model="bride_name" :autofocus="true" class="custom" placeholder="Bride's full name*"
                     type="text"></ion-input>
        </ion-item>

        <ion-item color="light" class="ion-margin-top" lines="none">
          <ion-input v-model="bride_phone_number" class="custom" inputmode="tel"
                     placeholder="Bride's phone number(optional)"></ion-input>
        </ion-item>

        <ion-item color="light" class="ion-margin-top" lines="none">
          <ion-input v-model="bride_email" class="custom" inputmode="email" lines="none"
                     placeholder="Bride's email address(optional)"></ion-input>
        </ion-item>

      </ion-list>


      <ion-list style="background-color: transparent !important;" v-else class="ion-margin-top">

        <ion-item color="light" lines="none">
          <ion-input v-model="groom_name" class="custom" placeholder="Groom's full name*" type="text"></ion-input>
        </ion-item>

        <ion-item color="light" class="ion-margin-top" lines="none">
          <ion-input v-model="groom_phone_number" class="custom" inputmode="tel"
                     placeholder="Groom's phone number(optional)"></ion-input>
        </ion-item>

        <ion-item color="light" class="ion-margin-top" lines="none">
          <ion-input v-model="groom_email" class="custom" inputmode="email"
                     placeholder="Groom's email address(optional)"></ion-input>
        </ion-item>

      </ion-list>


    </div>


    <div v-if="step==4" class="smooth-in">

      <p class="ion-text-center ion-no-margin">
        <span style="font-size: 70px">🎊</span>

      </p>

      <h2 class="ion-text-center ion-no-margin">All about the big day!</h2>

      <!--      <alert-component class="ion-margin-top" title="What's a tag?"-->
      <!--                       description="A tag is a unique text that identifies your wedding registry link. If you do not create one, a random tag would be created for you."></alert-component>-->

      <ion-list style="background-color: transparent !important;" class="ion-margin-top">

        <ion-item color="light"  lines="none">
          <ion-input v-model="tag" class="custom" placeholder="Wedding #tag (optional)" type="text"></ion-input>
        </ion-item>

        <ion-item color="light"  class="ion-margin-top" lines="none">
          <ion-label>Date & Time:</ion-label>
          <ion-datetime-button datetime="datetime"></ion-datetime-button>
          <ion-modal

              :keep-contents-mounted="true">
            <ion-datetime id="datetime" :show-default-buttons="true" hourCycle="h12" locale="en-GB"
                          @ionChange="dateSelected">
              <span slot="title">Set the wedding date & tIme</span>
            </ion-datetime>
          </ion-modal>

        </ion-item>

        <ion-item color="light"  class="ion-margin-top" lines="none">
          <ion-input v-model="rsvPhoneNumber" :autoGrow="true" class="custom" inputmode="tel"
                     placeholder="RSVP Tel number*"></ion-input>
        </ion-item>

        <ion-item  color="light" class="ion-margin-top" lines="none">
          <ion-input v-model="rsvPerson" class="custom" placeholder="RSVP contact person name*"></ion-input>
        </ion-item>

        <ion-item color="light"  class="ion-margin-top" lines="none">
          <ion-textarea v-model="location" :autoGrow="true" class="custom"
                        placeholder="Describe the location (optional)"
                        rows="1"></ion-textarea>
        </ion-item>


      </ion-list>

      <div v-if="googlePlace" class="place-container ion-padding ion-text-center">

        <ion-icon :icon="locationOutline" color="primary" size="large"></ion-icon>
        <h3>{{ googlePlace.route }}</h3>
        <p>
          <small class="text-muted">{{ googlePlace.administrative_area_level_1 }}
            {{ googlePlace.administrative_area_level_2 }}, {{ googlePlace.country }}</small>
        </p>

        <ion-button
            fill="outline"
            mode="ios"
            shape="round"
            size="small"
            @click="googlePlace=null"
        >
          <ion-icon :icon="pencilOutline"></ion-icon>
        </ion-button>


      </div>

      <ion-button
          v-if="!googlePlace"
          id="open-map"
          expand="block"
          fill="clear"
          mode="ios"
          shape="round"
          size="large"

      >Attach map location
        <ion-icon :icon="locationOutline"></ion-icon>
      </ion-button>

      <ion-modal
          v-if="!googlePlace"
          ref="modal"
          :breakpoints="[0, 0.25, 0.5, 0.75,1]"
          :initial-breakpoint="0.5"
          handle-behavior="cycle"
          mode="ios"
          trigger="open-map"
      >
        <google-places-component
            @canceled="cacnelSearch"
            @placeSelected="setPlace"
        ></google-places-component>
      </ion-modal>

      <ion-button
          expand="block"
          fill="clear"
          mode="ios"
          shape="round"
          size="large"
          @click="showSocial=!showSocial"

      >Add video links
        <ion-icon v-if="!showSocial" :icon="caretDownOutline"></ion-icon>
        <ion-icon v-else :icon="caretUpOutline"></ion-icon>
      </ion-button>

      <ion-item v-if="showSocial" class="ion-margin-top" lines="none" style="transition: 0.3s ease-in-out">

        <small class="text-muted ion-text-center" >
          If you have scheduled zoom and youtube live videos, you can add them to your wedding page by putting the links here.
        </small>

      </ion-item>

      <ion-item color="light" v-if="showSocial" class="ion-margin-top" lines="none">
        <ion-input v-model="zoomLink" class="custom" inputmode="url" placeholder="Zoom link"></ion-input>
      </ion-item>

      <ion-item color="light"  v-if="showSocial" class="ion-margin-top" lines="none">
        <ion-input v-model="youtubeLink" class="custom" inputmode="url" placeholder="YouTube link"></ion-input>
      </ion-item>


    </div>

    <div v-if="step===5" class="smooth-in">

      <h2 class="ion-text-center">Let's style things up</h2>

      <p>Add upto 4 photos to your wedding page:</p>
      <ion-grid>

        <ion-row>
          <ion-col size="6">
            <thumbnail-component uuid="img1" @photoSelected="file=>photoOne=file"></thumbnail-component>
          </ion-col>

          <ion-col size="6">
            <thumbnail-component uuid="img2" @photoSelected="file=>photoTwo=file"></thumbnail-component>
          </ion-col>


          <ion-col size="6">
            <thumbnail-component uuid="img3" @photoSelected="file=>photoThree=file"></thumbnail-component>
          </ion-col>


          <ion-col size="6">
            <thumbnail-component uuid="img4" @photoSelected="file=>photoFour=file"></thumbnail-component>
          </ion-col>


        </ion-row>
      </ion-grid>

      <p>Share something nice about your union:</p>

      <ion-item color="light" class="ion-margin-top" lines="none">
        <ion-textarea v-model="story" :autoGrow="true" class="custom" placeholder="A short beautiful story"
                      rows="1"></ion-textarea>
      </ion-item>
      <ion-button id="ai-help-button" class="ion-margin" expand="block" fill="clear" mode="ios">Seek suggestions
      </ion-button>

      <ion-modal
          ref="AImodal"
          :breakpoints="[0, 0.25, 0.5, 0.75,1]"
          :initial-breakpoint="0.75"
          handle-behavior="cycle"
          mode="ios"
          trigger="ai-help-button"
      >
        <love-ai-component @selected="suggestionSelected"></love-ai-component>
      </ion-modal>
      <p>How do you want to say thank you?</p>
      <ion-radio-group :value="thankYouvalue">

        <swiper :options="slideOption" :scrollbar="true">


          <swiper-slide v-for="(page,index) in sampleThanks" :key="index">
            <ion-card class="ion-text-left" color="primary" mode="ios"
                      @click="thankYouvalue=index; thankYouText=page.text.trim()">
              <ion-item color="primary">
                <ion-radio :value="index" color="warning"></ion-radio>
                <ion-label>Select</ion-label>
              </ion-item>
              <ion-card-header>
                <ion-card-title>{{ page.title }}


                </ion-card-title>
              </ion-card-header>
              <ion-card-content class="ion-text-left">

                <p>{{ page.text }}</p>
                <ion-card-subtitle>
                  {{ page.subTitle }}<br>
                  {{ groom_name }} & {{ bride_name }}
                </ion-card-subtitle>
              </ion-card-content>

            </ion-card>
          </swiper-slide>

        </swiper>

      </ion-radio-group>


<!--      <ion-item class="ion-margin-top" lines="none">-->

<!--        <ion-textarea-->
<!--            v-model="thankYouText"-->
<!--            :autoGrow="true"-->
<!--            class="custom"-->
<!--            placeholder="Edit thank you message"-->
<!--            rows="1"-->
<!--        ></ion-textarea>-->

<!--      </ion-item>-->

    </div>

    <div v-if="step===6" class="smooth-in ion-color-primary" style="height: 100vh">

      <swiper :options="previewSlideOption" :pager="true">


        <swiper-slide v-if="photoOne">

          <ion-card class="card-gradient no-margin" mode="ios" style="width: 100%; height: 300px;margin: 0!important;">
            <ion-card-header class="ion-margin-top ion-padding-top">
              <ion-card-title style="color: white!important;">Our Story
                <ion-icon :icon="heartCircleOutline"></ion-icon>

              </ion-card-title>

            </ion-card-header>

            <ion-card-content>

              <span v-html="story">

              </span>
            </ion-card-content>

          </ion-card>


        </swiper-slide>


        <swiper-slide v-if="photoOne">
          <div :style="'background-image:url('+photoOne.preview+')'"
               style="height: 300px; width: 100%; background-repeat: no-repeat; background-size: cover; border-radius: 3%;">
          </div>

        </swiper-slide>

        <swiper-slide v-if="photoTwo">
          <div :style="'background-image:url('+photoTwo.preview+')'"
               style="height: 300px; width: 100%; background-repeat: no-repeat; background-size: cover; border-radius: 3%;">
          </div>

        </swiper-slide>

        <swiper-slide v-if="photoThree">

          <div :style="'background-image:url('+photoThree.preview+')'"
               style="height: 300px; width: 100%; background-repeat: no-repeat; background-size: cover; border-radius: 3%;">
          </div>

        </swiper-slide>

        <swiper-slide v-if="photoFour">
          <div :style="'background-image:url('+photoFour.preview+')'"
               style="height: 300px; width: 100%; background-repeat: no-repeat; background-size: cover; border-radius: 3%;">
          </div>

        </swiper-slide>

      </swiper>


      <ion-list :inset="true" lines="inset">
        <ion-list-header>
          <ion-label>
            <ion-icon :icon="personOutline"></ion-icon>
            Bride's Info.
          </ion-label>
        </ion-list-header>
        <ion-item color="light" style="margin: 5px">
          <ion-label><h1>{{ bride_name ? bride_name : "N/A" }}</h1>
            <p>Name</p>
          </ion-label>
        </ion-item>
        <ion-item color="light" style="margin: 5px">
          <ion-label><h1>{{ bride_phone_number ? bride_phone_number : "N/A" }}</h1>
            <p>Phone Number</p>
          </ion-label>
        </ion-item>
        <ion-item color="light" style="margin: 5px">
          <ion-label><h1>{{ bride_email ? bride_email : "N/A" }}</h1>
            <p>Email</p>
          </ion-label>
        </ion-item>


        <ion-list-header>
          <ion-label>
            <ion-icon :icon="personOutline"></ion-icon>
            Groom's Info.
          </ion-label>
        </ion-list-header>
        <ion-item color="light" style="margin: 5px">
          <ion-label><h1>{{ groom_name ? groom_name : "N/A" }}</h1>
            <p>Name</p>
          </ion-label>
        </ion-item>
        <ion-item color="light" style="margin: 5px">
          <ion-label><h1>{{ groom_phone_number ? groom_phone_number : "N/A" }}</h1>
            <p>Phone Number</p>
          </ion-label>
        </ion-item>
        <ion-item color="light" style="margin: 5px">
          <ion-label><h1>{{ groom_email ? groom_email : "N/A" }}</h1>
            <p>Email</p>
          </ion-label>
        </ion-item>


        <ion-list-header>
          <ion-label>
            <ion-icon :icon="informationOutline"></ion-icon>
            About the wedding
          </ion-label>
        </ion-list-header>

        <ion-item color="light" style="margin: 5px">
          <ion-label>
            <h1>{{ tag ? tag : "N/A" }}</h1>
            <p>
              Wedding Tag
            </p>
          </ion-label>
        </ion-item>
        <ion-item color="light" style="margin: 5px">
          <ion-label><h1>{{ date ? formatedDate(date) : "N/A" }}</h1>
            <p>Date & Time</p>
          </ion-label>
        </ion-item>
        <ion-item color="light" style="margin: 5px">
          <ion-label><h1>{{ rsvPhoneNumber ? rsvPhoneNumber : "N/A" }}</h1>
            <p>RSV Tel.</p>
          </ion-label>
        </ion-item>

        <ion-item color="light" style="margin: 5px">
          <ion-label>
            <h1>{{ rsvPerson ? rsvPerson : "N/A" }}</h1>
            <p>RSV Person</p>

          </ion-label>
        </ion-item>


        <ion-list-header v-if="youtubeLink&&zoomLink">
          <ion-label>
            <ion-icon :icon="linkOutline"></ion-icon>
            Links
          </ion-label>
        </ion-list-header>


        <ion-item v-if="youtubeLink" color="light" style="margin: 5px">
          <ion-button :href="youtubeLink" color="danger" expand="block" fill="clear" mode="ios" size="large">
            <ion-icon :icon="logoYoutube"></ion-icon>
            YouTube
          </ion-button>
        </ion-item>

        <ion-item v-if="zoomLink" color="light" style="margin: 5px">
          <ion-button :href="zoomLink" color="primary" expand="block" fill="clear" mode="ios" size="large">Zoom
          </ion-button>
        </ion-item>

      </ion-list>


    </div>


  </ion-content>


  <ion-footer v-if="step>2" :translucent="true" collapse="fade">
    <ion-progress-bar :value="progressvalue" buffer=".8" class="ion-margin-top"></ion-progress-bar>

    <ion-toolbar>
      <ion-button slot="start" fill="clear" mode="ios" @click="step--">
        <ion-icon :icon="caretBackOutline"></ion-icon>
        Prev.
      </ion-button>

      <ion-button v-if="step<6" slot="end" mode="ios" shape="round" size="large" @click="gotoNext(step)">

        {{ step === 5 ? "Preview" : "Continue" }}

        <ion-icon v-if="step<=5" :icon="caretForwardOutline"></ion-icon>

      </ion-button>

      <ion-button v-else slot="end" :disabled="loading" color="success" mode="ios" shape="round" size="large"
                  @click="saveEvent">
        <template v-if="!loading">

          Create event
          <ion-icon :icon="checkmarkOutline"></ion-icon>
        </template>
        <ion-spinner v-else></ion-spinner>
      </ion-button>
    </ion-toolbar>
  </ion-footer>
</template>

<script>


import {
  IonAvatar,
  IonButton,
  IonCard,
  IonCardContent,
  IonCardHeader,
  IonCardSubtitle,
  IonCardTitle,
  IonCol,
  IonContent,
  IonDatetime,
  IonDatetimeButton,
  IonFooter,
  IonGrid,
  IonIcon,
  IonInput,
  IonItem,
  IonLabel,
  IonList,
  IonListHeader,
  IonModal,
  IonProgressBar,
  IonRadio,
  IonRadioGroup,
  IonRow,
  IonSpinner,
  IonTextarea,
  IonToolbar
} from "@ionic/vue";

import { Swiper, SwiperSlide } from 'swiper/vue';

import WeddinWelcomAnimation from "@/components/weddinWelcomAnimation";
import {
  arrowForwardOutline,
  caretBackOutline,
  caretDownOutline,
  caretForwardOutline,
  caretUpOutline,
  checkmarkCircle,
  checkmarkOutline,
  femaleOutline,
  heartCircleOutline,
  informationOutline,
  linkOutline,
  locationOutline,
  logoYoutube,
  maleOutline,
  pencilOutline,
  personOutline
} from "ionicons/icons";
import ThumbnailComponent from "@/components/thumbnailComponent";
import GooglePlacesComponent from "@/components/GooglePlacesComponent";
import axios from "axios";
import LoveAiComponent from "@/components/loveAiComponent";
import moment from "moment";

export default {
  name: "weddingRegistryComponent",
  components: {
    Swiper, SwiperSlide,
    IonSpinner,
    LoveAiComponent,
    IonListHeader,
    IonProgressBar,
    GooglePlacesComponent,
    IonAvatar,
    ThumbnailComponent,
    WeddinWelcomAnimation,
    IonContent,
    IonButton,
    IonIcon,
    IonList,
    IonItem,
    IonInput,
    IonToolbar,
    IonFooter,
    IonLabel,
    IonTextarea,
    IonDatetimeButton,
    IonModal,
    IonDatetime,
    IonRow,
    IonCol,
    IonGrid,

    IonCard,
    IonCardHeader,
    IonCardTitle,
    IonCardContent,
    IonCardSubtitle,
    IonRadioGroup,
    IonRadio
  },
  data() {
    return {
      heartCircleOutline,
      pencilOutline,
      story: "",
      linkOutline,
      logoYoutube,
      informationOutline,
      personOutline,
      youtubeLink: "",
      zoomLink: "",
      photoOne: null,
      photoTwo: null,
      photoThree: null,
      photoFour: null,
      rsvPhoneNumber: "",
      rsvPerson: "",
      location: "",
      showSocial: false,
      caretUpOutline,
      caretDownOutline,
      thankYouText: "",
      showMore: false,
      dialogCanDismiss: false,
      slideOption: {
        initialSlide: 0,
        speed: 400,
        effect: "overflow"
      },
      previewSlideOption: {
        slidesPerView: 1,
        cycle: true,
        initialSlide: 0,
        speed: 400,
        effect: "overflow",
        autoplay: {
          delay: 5000,
        }

      },
      thankYouvalue: 0,
      sampleThanks: [
        {
          title: "Dear [Name],",
          text: "We are so thankful to have your love and support towards our wedding day.\n" +
              "                We wouldn’t want it any other way. Thank you for playing a big part in making our big day a reality.\n" +
              "                We truly appreciate you.\n" +
              "                All our love,",
          subTitle: ""
        },
        {
          title: "Dear [Donor],",

          text: "This is a note to thank you for being there for us and supporting us.\n" +
              "                Your gift to us means more than you know. We are grateful to have family/friends\n" +
              "                like you who will do everything to celebrate our union.\n" +
              "                Thank you for reaching into your heart to share this gift with us.\n" +
              "                We love having you in our life.",
          subTitle: "Much love,"
        },
        {
          title: "Dear [Donor],",
          text: "Thank you for contributing to our wedding.\n" +
              "                Because of your generosity we will be able to celebrate our love with friends and family like you.",
          subTitle: "Thanks again,"

        },

      ],
      addMap: false,
      tag: "",
      arrowForwardOutline,
      maleOutline,
      femaleOutline,
      step: 1,
      userIsGroom: false,
      groosatusSeleted: false,
      checkmarkOutline,
      caretBackOutline,
      caretForwardOutline,
      checkmarkCircle,
      locationOutline,
      groom_name: null,
      groom_phone_number: "",
      groom_email: "",
      bride_name: null,
      bride_phone_number: "",
      bride_email: "",
      date: "",
      dateTime: "",
      maxStep: 5,
      googlePlace: null,
      loading: false
    }
  },
  watch: {
    step() {

      this.$store.state.headerTransparent = this.step >= 6;

    }
  },
  computed: {

    goeLocation() {
      if (this.googlePlace) {
        return this.googlePlace.longitude + "," + this.googlePlace.latitude;
      }

      return null;

    },
    progressvalue() {

      return (this.step / this.maxStep).toFixed(2);

    },
    user() {
      return this.$store.state.user;
    },
    avatarUrl() {
      return this.userIsGroom ? "https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/person1.png" : "https://objectstorage.uk-london-1.oraclecloud.com/n/lrj6a9vl4is6/b/MyBucket/o/avatar-2191918.png";

    }
  },
  methods: {

    formatedDate(date) {

      return moment(date).format('MMMM Do YYYY, h:mm:ss a');

    },

    suggestionSelected(story) {

      this.story = story;
      this.$refs.AImodal.$el.dismiss(null, 'cancel');

    },

    setPlace(place) {
      this.googlePlace = place;

    },

    saveEvent() {

      this.loading = true;

      const formData = new FormData();

      formData.append("bride_name", this.bride_name);
      formData.append("bride_phone_number", this.bride_phone_number);
      formData.append("bride_email", this.bride_email);
      formData.append("groom_name", this.groom_name);
      formData.append("groom_phone_number", this.groom_phone_number);
      formData.append("groom_email", this.groom_email);
      formData.append("tag", this.tag);
      formData.append("date_time", this.date);
      formData.append("youtube_link", this.youtubeLink);
      formData.append("zoom_link", this.zoomLink);
      formData.append("location", this.location);
      formData.append("coordinates", this.goeLocation);
      formData.append("story", this.story);
      formData.append("rsv_phone_number", this.rsvPhoneNumber);
      formData.append("rsv_person", this.rsvPerson);
      formData.append("photo_one", this.photoOne ? this.photoOne.file : null);
      formData.append("photo_two", this.photoTwo ? this.photoTwo.file : null);
      formData.append("photo_three", this.photoThree ? this.photoThree.file : null);
      formData.append("photo_four", this.photoFour ? this.photoFour.file : null);


      axios.post("/wedding", formData)
          .then(res => {

            this.loading = false;

            const url = "/event/wedding/" + res.data.data.id;
            this.$router.push({path: url});

          })
          .catch(error => {

            this.$store.state.mainLoading = false;
            this.loading = false;


          })


    },


    dateSelected(dateTime) {
      this.date = dateTime.detail.value;
    },
    gotoNext(index) {

      if (index === 3) {
        if (this.userIsGroom && !this.bride_name) {

          this.$store.state.ErrorPosition = "top";
          this.$store.state.errorsArr = {name: ["You said you are the groom, Bride's name is required"]};
          this.$store.state.showErrorToast = true;
          return;

        } else if (!this.userIsGroom && !this.groom_name) {
          this.$store.state.ErrorPosition = "top";

          this.$store.state.errorsArr = {name: ["You said you are the bride, Groom's name is required"]};
          this.$store.state.showErrorToast = true;
          return;

        }


      }


      if (index === 4) {

        if (!this.rsvPhoneNumber) {
          this.$store.state.ErrorPosition = "top";

          this.$store.state.errorsArr = {name: ["RSVP Phone number is required"]};
          this.$store.state.showErrorToast = true;

          return;
        }

        if (!this.date) {

          this.$store.state.ErrorPosition = "top";
          this.$store.state.errorsArr = {name: ["Date and time not selected"]};
          this.$store.state.showErrorToast = true;

          return;
        }


        if (!this.rsvPerson) {
          this.$store.state.ErrorPosition = "top";

          this.$store.state.errorsArr = {name: ["RSVP person name is required"]};
          this.$store.state.showErrorToast = true;

          return;


        }
      }

      this.step = index + 1;

    },
    cacnelSearch() {
      this.dialogCanDismiss = true;

      this.$refs.modal.$el.dismiss(null, 'cancel');

      this.dialogCanDismiss = false;

    },
    setUser() {
      if (this.userIsGroom) {

        this.groom_name = this.user.first_name + " " + this.user.last_name;
        this.groom_email = this.user.email;
        this.groom_phone_number = this.user.phone_number;
        this.bride_email = "";
        this.bride_phone_number = "";
        this.bride_name = "";

      } else {

        this.groom_name = "";
        this.bride_name = this.user.first_name + " " + this.user.last_name;
        this.bride_email = this.user.email;
        this.bride_phone_number = this.user.phone_number;

        this.groom_email = "";
        this.groom_phone_number = "";

      }
      this.step = 3;

    },
    start() {
      this.step = 2;
    }
  }

}
</script>


<style scoped>

.love-image {
  animation: leaves 0.4s ease-in-out;
}

@keyframes leaves {
  0% {
    transform: scale(0.5);
  }
  100% {
    transform: scale(1.0);
  }
}

.place-container {

  border: 1px solid #cccccc;
  border-radius: 1%;
}

.card-gradient {

  --background: rgb(131, 58, 180);
  background: linear-gradient(90deg, rgba(131, 58, 180, 1) 0%, rgba(253, 29, 29, 1) 50%, rgba(252, 176, 69, 1) 100%);
  color: #ffffff !important;
  box-shadow: none !important;
}

ion-thumbnail {
  --size: 100%;
  --border-radius: 14px;
}

@keyframes slide-in {
  0% {
    opacity: 0;
    transform: translateX(250px);
  }

  100% {
    opacity: 1;
    transform: translateX(0);
  }
}

.font-weight-light {
  font-weight: lighter;
}


.smooth-in {
  animation: slide-in 0.3s ease-in-out 0s 1 normal forwards;
}

.content-span {
  margin-top: 30%;
  position: absolute;
  width: 90%;
}
</style>