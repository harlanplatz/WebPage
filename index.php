<?php 
if(isset($_POST['submit'])){
    $to = "email@example.com"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $subject = "Form submission";
    $subject2 = "Copy of your form submission";
    $message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['message'];
    $message2 = "Here is a copy of your message " . $first_name . "\n\n" . $_POST['message'];

    $headers = "From:" . $from;
    $headers2 = "From:" . $to;
    mail($to,$subject,$message,$headers);
    mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
    echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";
    // You can also use header('Location: thank_you.php'); to redirect to another page.
    }
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="UTF-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Harlan Platz Law</title>
    <meta name="description" content="Harlan Platz Law" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" src="img/hapwood_shadow.png" sizes="32x32" />
    <link rel="icon" type="image/png" src="img/hapwood_shadow.png" sizes="16x16" />
    <link rel="stylesheet" href="css/normalize.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery.fancybox.css">
    <link rel="stylesheet" href="css/flexslider.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/queries.css">
    <link rel="stylesheet" href="css/list.css">
    <link rel="stylesheet" href="css/list.css">
    <link rel="stylesheet" href="css/tree.css">
    <link rel="stylesheet" href="css/etline-font.css">
    <link rel="stylesheet" href="bower_components/animate.css/animate.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script
    <script src="js/globalJquery.js"></script>
    <script src="js/modernizr.custom.js"></script>
    <link rel="stylesheet" type="text/css" href="css/default.css" />
    <link rel="stylesheet" type="text/css" href="css/component.css" />
</head>
<body id="top">
    <section class="hero">
        <section class="navigation">
            <header>
                <div class="header-content">
                    <div class="logo"><img src="img/hapwood_shadow.png"></div>
                    <div class="header-nav">
                        <nav>
                            <ul class="primary-nav" style="margin-left:5vw;"> <!-- display: inline-block -->
                                <li><a href="#FirmOverview">Firm Overview</a></li>
                                <li><a href="#Areas">Areas Of Practice</a></li>
                                <li><a href="#Results">Case Results</a></li>
                                <li><a href="#Contact">Contact Us</a></li>
                            </ul> 
                        </nav>
                    </div>
                   <div class="navicon">
                        <a class="nav-toggle" href="#"><span></span></a>
                    </div>
                </div>
        <!-- <div style="margin-left:20vw">
            <p class ="contactNav">200 Willis Ave, Mineloa, NY</p>
            <p class="contactNav" style="margin-left:2em;">(516) 279-4800</p>
        </div> -->
        </header>
    </section>
    
        <div class="down-arrow floating-arrow">
            <a href="#"><i class="fa fa-angle-down"></i></a>
        </div>
</section>

            
            
            
        </section>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="hero-content text-center">
                                     
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="intro section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-5 intro-feature">
                    <div>
                        <h5 style="text-align:center;">PERSONAL INJURY & ACCIDENT CASES</h5>
                        <p>Our civil justice system is designed to compensate innocent victims of carelessness and violations of safety codes when they become injured as a result. No one can take away the pain and suffering that an innocent victim may experience; however our legal system does attempt to compensate victims by payment of money damages.
If you are a victim of an accident, or are injured due to the negligence of another, you may be entitled to a cash award, health care benefits and other compensation. Our Personal Injury Counsel can assist you with all types of negligence cases, including auto and transit accidents, construction accidents, slip and fall injuries and wrongful death claims, among others. Most injury claims are subject to strict time limits, it is important to obtain legal advice as soon as possible. In some cases, such as no-fault, or claims against certain governmental entities, notices of claim must be filed in as few as 30 days of an injury. So if you are injured, you should promptly consult with our law firm to determine your rights.
                        </p>
                    </div>
                </div>
                
            </div>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-md-4 intro-feature">
                    <div>
                        <h5 style="text-align:center;">CONTACT AN ATTORNEY</h5>
                        <p>It does not cost anything to learn about your rights. An injured person should be entitled to fair and just compensation. However, obtaining that to which you are entitled is not automatic. The Law Office of Harlan A. Platz, P.L.L.C. will inquire, investigate, and litigate to obtain that to which you are entitled. The sooner you seek counsel, the more likely it is that you will receive the health care and monetary benefits you deserve.</p>
                    </div>
                </div>
                <div class="col-md-4 intro-feature">
                    <div>
                        <h5 style="text-align:center;">FREE INITIAL CONSULTATION</h5>
                        <p>If you have been injured or disabled in any way, it is advisable that you seek experienced legal counsel immediately. We are here to help you learn your rights and explore your options. Simply call us to discuss your injuries and losses. If you have a viable claim, we will set up an appointment to meet with you. If your injuries prevent you from visiting our office, we will come to you. Remember, time is of the essence and any statements made prior to consulting an attorney may jeopardize your claim.</p>
                    </div>
                </div>
                <div class="col-md-4 intro-feature">
                    <div>
                        <h5 style="text-align:center;">NO RECOVERY, NO FEE</h5>
                        <p>At the Law Office of Harlan A. Platz, P.L.L.C. we know how hard it is to make ends meet, and it’s even harder to get by when you become disabled and unable to work. Legal bills are the last thing you need when you’re not working. That’s why the personal injury and accident cases we handle are on a contingency fee basis. This means that you will never be charged for time or services unless and until you receive a cash award. No recovery- no fee… that is our policy regarding personal injury lawsuits.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-5 intro-feature">
                    <div>
                        <h5 style="text-align:center;">STOCK FRAUD CASES</h5>
                        <p>
                            You have sacrificed a lot to earn your retirement income, and when you trust a securities firm to maintain(and hopefully grow) it, you expect to receive truthful, professional, and accurate information about your investments and sound investment advice that suiys your particular needs. To contact us for a free confidential consult, you can call us at (516) 279-4800. You also can request a free private and confidential evaluation and your inquiry will be immediately reviewed by an expert who handles your specific type case. 
                        </p>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <section>
    <section class="features section-padding" id="features">
        <div class="container" style="background-color:#F3F4F8;">
            <a name="FirmOverview"><h2 style="padding-top: 225px; margin-top: -225px; text-align: center;">Firm Overview</h2></a>
            <p>Harlan A. Platz, Esq. is the founder of The Law Office of Harlan A. Platz, P.L.L.C.              in Long Island. He specializes in handling catastrophic injury and wrongful death cases involving construction sites, auto and transit accidents, building and sidewalk accidents, lead poisoning, medical malpractice, and securities fraud claims. He is widely respected as a legal professional who delivers superior service and attains outstanding recoveries for his clients. He has established himself as a tough and skilled negotiator who is able to settle cases for maximum value. Mr. Platz is often called upon by other trial attorneys to negotiate cases on their behalf.
<br><br>
Mr. Platz was born June 13, 1962. He graduated from Harper College at SUNY Binghamton receiving the Outstanding Performance Award in 1984. He then went on to receive his Juris Doctor degree at St. John’s University Law School in Queens in 1987. He was admitted to practice law in the State of New York in 1988 and the following year Mr. Platz was admitted to the U.S. District Courts for both the Southern and Eastern Districts of New York.
<br><br>
Harlan A. Platz soon accepted a position as an associate at the legendary Manhattan firm, Schneider, Kleinick & Weitz, which was New York’s pre-eminent plaintiff’s personal injury law firm. He remained there until 1995 when he decided to open his own law firm.
<br><br>
Mr. Platz is a member of the New York State Bar Association and New York State Trial Lawyers Association. He is a member of the Cambridge “Who’s Who” as a professional representing the personal injury law industry. Mr. Platz’s hard work and total dedication to his clients since 1988, together with his ability to repeatedly accomplish superior results in personal injury and accident cases, has been certified by Million Dollar Advocates Forum and Multi-Million Dollar Advocates Forum. All members have achieved a trial verdict, award, or settlement for one million dollars or more. Mr. Platz has achieved this benchmark numerous times for his clients. This honored designation is given only to trial lawyers who demonstrate exceptional skill, experience, and excellence in advocacy. He has also been named as a ‘Super Lawyer’ and ‘Top Attorney’ in the New York Metro area by the American Registry Association.
<br><br>
Mr. Platz is a member of the New York State Bar Association and New York State Trial Lawyers Association. He is a member of the Cambridge “Who’s Who” as a professional representing the personal injury law industry. Mr. Platz’s hard work and total dedication to his clients since 1988, together with his ability to repeatedly accomplish superior results in personal injury and accident cases, has been certified by Million Dollar Advocates Forum and Multi-Million Dollar Advocates Forum. All members have achieved a trial verdict, award, or settlement for one million dollars or more. Mr. Platz has achieved this benchmark numerous times for his clients. This honored designation is given only to trial lawyers who demonstrate exceptional skill, experience, and excellence in advocacy. He has also been named as a ‘Super Lawyer’ and ‘Top Attorney’ in the New York Metro area by the American Registry Association.
        
            </p>
            
            
        </div>
        <div class="device-showcase">
            <div class="devices">
                <div class="ipad-wrap wp1"></div>
                <div class="iphone-wrap wp2"></div>
            </div>
        </div>
    </section>
    <section class="features-extra section-padding" id="assets">
        <div class="container">
            <a name="Areas"><h2 style="padding-top: 225px; margin-top: -225px; text-align: center;">Areas Of Practice</h2></a>
            
                <ul class=mtree>
                   <li><a href="#" style="font-size:4em;">PERSONAL INJURY & ACCIDENT CASES</a></li>
                  <li><a href="#">AUTO & TRANSIT ACCIDENTS</a>
                    <ul>
                      <li>Whether you’re a passenger, driver, or pedestrian, if you are injured in an auto or transit accident you may be entitled to multiple forms of compensation. Regardless of fault, most injured persons are entitled to lost earnings and medical coverage through no-fault insurance. In addition, if you have sustained a serious injury, you may be entitled to compensation for the pain and suffering endured. Your spouse may be also entitled to a claim for “loss of services”. It is important that you seek legal counsel immediately whenever you have been involved in an accident.
                      </li>
                    </ul>
                  </li>
                  <li><a href="#">CONSTRUCTION ACCIDENTS</a>
                    <ul>
                      <li>Workers injured on or around a construction site may be entitled to make a third party negligence claim against the party liable for the injury, usually a general contractor or property owner. In addition to receiving Workers’ Compensation and Social Security Disability Benefits, injured construction workers may be entitled to further compensation under the safe workplace provisions of the Labor Law. Ladder, scaffold, defective machinery, and unsafe workplace claims may have enormous potential monetary value, so it is important to obtain appropriate and timely advice.
                      </li>
                    </ul>
                  </li>
                  <li><a href="#">BUILDING & SIDEWALK ACCIDENTS</a>
                    <ul>
                      <li>Some of the most common types of personal injury lawsuits involve slip and fall accidents caused by unsafe buildings, sidewalks and roadways. Property owners, lessees, building managers, and maintenance companies are responsible for constructing and maintaining their property safely. Municipalities are similarly charged with proper maintenance of roadways and sidewalks. If these parties are negligent, and their negligence causes you to be injured, they can be held liable for your pain, suffering, and immediate and future loss of wages.
                      </li>
                    </ul>
                  </li>
                  <li><a href="#">WRONGFUL DEATH</a>
                    <ul>
                      <li>Sadly, the negligence of others can sometimes result in the untimely death of an innocent victim. The responsible party can be held liable by the estate of the victim for conscious pain and suffering and loss of future earnings and other economic loss. For example, if the head of a household who is responsible for most of a family’s income is killed as the result of another party’s negligence, his or her family may be entitled to substantial cash recoveries. It is important that the family seek proper legal counsel immediately.
                      </li>
                    </ul>
                  </li>
                  <li><a href="#">LEAD POISONING</a>
                    <ul>
                      <li>Lead poisoning most often occurs when young children (toddlers) start crawling around the home and get lead dust on their hands. These children then engage in normal hand-to-mouth activity and it is this activity during which the child actually becomes lead poisoned. More severe cases may involve pica where children actually eat lead based paint chips. By far the most common source of lead poisoning in children is deteriorating lead based paint in older homes.
<br><br>
THE INJURIES CAUSED BY LEAD POISONING
<br><br>
The greatest risk of injury from lead poison is to children under the age of seven, whose developing bodies and brains are sensitive to even small amounts of lead, which can leave children with irreversible neurological injury that does not appear until many years after exposure to lead. The kinds of injuries lead causes in children include: Learning disabilities, Brain damage (sometimes subtle), Loss of IQ Points and Intellect, Academic failure, Neuropsychological deficits, Attention Deficit Disorder, Hyperactive behavior, Antisocial (criminal) behavior, Neurological problems, Encephalopathy (brain swelling), Major Organ FailureComa and Death.

These injuries can be life-threatening or can prevent a child from realizing his or her scholastic, vocational, and financial potential, or from becoming self-sufficient adult. Studies have shown 
that lead poisoned children are more likely to drop out of high school and to live a lifetime of 
unemployment. Lead poisoning can take important abilities from a child.
<br><br>HAS YOUR CHILD BEEN LEAD POISONED?<br><br>
Very often parents are not aware if their child has been lead poisoned for a number of reasons: 
<br>
1.  The definition of lead poisoning has decreased from 60 ug/dl to 10 ug/dl. Older children with lead levels of under 25 were not considered lead poisoned. <br>
2. The Dept. of Health of most municipalities has set 20 ug/dl as their action level. That is to say, they will not intervene when a child’s blood lead levels are between 10 and 19 ug/dl, even though the child is lead poisoned. <br>
3. Although some health care providers are diligent about screening for lead and properly advising parents, unfortunately others are not. This has resulted in the failure of children to be screened for lead poisoning at ages 6 months to a year as required by the Guidelines set down in the Center for Disease Control Statement of October 1991. Follow-up screening is, sadly, also not undertaken in many cases. 
<br><br>
If your child has demonstrated learning disabilities, loss of cognition, and unexplainable low IQ, you should consider that lead poisoning may have been a contributing factor to these problems. The Law Office of Harlan A. Platz, P.L.L.C. in a meritorious case will undertake to accumulate the child’s medical and school records and have them reviewed by doctors knowledgeable in the effects of lead poisoning in children.
<br>
If you have questions, please call us or send us an e-mail.
        
        
        </li>
                    </ul>
                  </li>
                  <li><a href="#">MEDICAL MALPRACTICE</a>
                    <ul>
                      <li>Physicians, nurses and other health care providers are human; they can, and do, make mistakes. Medical malpractice is the failure of a health care provider -- usually a doctor, hospital, or health care institution -- to provide a patient with treatment that satisfies the customary standard of care provided by the medical industry. In order to bring a successful action, that failure to measure up to the standard of care must result in an injury to the patient; and it must be a substantial cause of the injury. If you think you or a loved one is the victim of medical malpractice, please contact us. In order to successfully pursue a New York medical malpractice claim, a patient must prove that a health care provider either failed to do something which a reasonably prudent health care provider would have done, or that (s)he did something that should not have been done; and that failure or action caused injury to the patient. Although doctors and hospital administrators often complain about “frivolous” litigation, the plain fact is that in New York, every case that is successful is supported by reports and/or testimony of medical doctors who are critical of the treatment that the patient received.
<br><br>
What makes a Good Case?
<br><br>
Obviously, a departure from good and accepted care by the doctor, hospital, midwife or nurse is a prerequisite for bringing a medical malpractice case. Causation is also necessary. That is, the departure must have caused the injury, which the plaintiff claims. However, in order to bring a viable case for medical malpractice, the injury must be severe and permanent. The reason is that medical negligent cases are costly to prosecute. The Law Office of Harlan A. Platz, P.L.L.C.  in a meritorious case will undertake to accumulate the medical records and have them reviewed by doctors knowledgeable in their area of expertise. 
<br>
If you have questions, please call us or send us an e-mail.
                      </li>
                    </ul>
                  </li>
                <li><a href="#" style="font-size:4em;">STOCK FRAUD CLAIMS</a></li>

                  <li ><a href="#" >Breach of Fiduciary Duty</a>
                    <ul>
                      <li>Regardless of a brokers specialty, he or she must adhere to moral and financial legalities or risk committing broker fraud. Many financial advisors provide broad investment advice regarding asset allocation and diversification. This investment advice has to be suitable to meet: the investor's age, financial objectives, risk tolerance and employment status.
<br><br>
A financial advisor violates his or her fiduciary duty to a client and acts against the client's 
wishes or best interest if the advice or recommendation provided does not meet the investor's 
specific needs.
                      </li>
                    </ul>
                  </li>
                  <li><a href="#" >Churning and Excessive Trading</a>
                    <ul>
                      <li>Churning in stock accounts is a form of investment fraud that involves the excessive transaction of your investment account's securities by your broker without regard for your financial objectives in order to generate commissions. Profitability is not a defense to churning a portfolio, however. If it were, a financial advisor could churn with impunity up to the gains of the portfolio. The Financial Industry Regulatory Authority (FINRA) prohibits the practice of churning and provides a securities arbitration process through which investors can seek to recover losses and illicit commissions. A successful churning claim requires proving that your broker had control or de-facto control of your investment account transactions and conducted transactions that were excessive in relation to your investment objectives, resources and risk tolerance and without regard for your best interests. Churning in stock accounts can be established using various methods, including calculations that can help determine whether a broker's transactions meet the definition of excessive. These calculations include assessing the commission-to-equity ratio and turnover rate securities in your investment account.
                      </li>
                    </ul>
                  </li>
                  <li><a href="#">Failure to Supervise</a>
                    <ul>
                      <li>Investment firms have a responsibility to establish and maintain rules regarding the supervision of their registered financial advisors and brokers. The supervision includes regular reviews of your portfolio to ensure it meets your investment objectives and risk tolerance. Broker-dealers are required to contact you in response to red flags to ensure you understand the risks involved with your holdings or trading strategy. If your investments lost money due to a representative's negligent or fraudulent behavior and the firm's failure to supervise played a role, we may be able to help you recover your losses.
                      </li>
                    </ul>
                  </li>
                  <li><a href="#">SEE FULL LIST ...</a>
                    <ul>
                      <li>
                 <li><a href="#" style="font-size:1em;">Investment Fraud and Misconduct</a>
                    <ul>
                      <li style="font-size:1em;">Many investors fall prey to the unethical practices of brokers who put their own interests above those of their clients. Common fraudulent investment products and scams include:
<br><br>Non-Traded Real Estate Investment Trusts (REITs): investors in non-traded REITs must rely on disclosures made by the sponsor of the REIT while paying high commissions. These investments are illiquid, expense, and often underperform compared to REITs traded on an open exchange.
<br><br>Junk Bonds: junk bonds are rated below investment grade by S&P and Moody's. They carry a high risk of default and are not suitable for investors seeking stable investments.
<br><br>PonziSchemes: these schemes promise high returns, but use money from new investors to pay earlier investors.
<br><br>Structured Notes: a hybrid security product that generally includes a stock or bond plus a derivative. They may include hidden costs and are often riskier than promised to investors.
<br><br>Variable annuities: investors pay high commissions and costs for these products with high 
penalties for liquidating. They are often not suitable for the elderly investors to whom they are 
recommended.
                      </li>
                    </ul>
                  </li> 
                  <li><a href="#" style="font-size:1em;">Margin Trading</a>
                    <ul>
                      <li style="font-size:1em;">A "margin" account is a brokerage account in which the brokerage firm loans money to the investor. While margin investing can double the gains on an investment, it also doubles the risk. In fact, because Interest immediately begins to be charged to the account and a temporary drop in the stock value can cause liquidation, the danger is even greater than many investors realize. Margin accounts are very profitable for brokerage firms. Brokers sometimes get a bonus on interest charged to their clients' accounts, but their goal Is usually to double commissions. When management fees are charged instead of commissions, these fees are charged on the portfolio size rather than the client's "equity" in the account. Thus, in addition to interest costs, commissions and fees double in margin accounts. Using margin is a high risk method of investing and is only appropriate for sophisticated investors who fully understand the risk.
                      </li>
                    </ul>
                  </li>    
                  <li><a href="#" style="font-size:1em;">Misrepresentations or Omissions</a>
                    <ul>
                      <li style="font-size:1em;">A brokerage firm or broker can be held liable if that firm, or broker misrepresents material facts or omits to disclose material facts to the investor regarding an Investment, and that client subsequently loses money on that investment. Often the misrepresentations or omissions disguise the risk associated with a particular investment. A broker has a duty to fairly disclose all of the risks associated with an investment.
                      </li>
                    </ul>
                  </li>    
                  <li><a href="#" style="font-size:1em;">Overconcentration of Assets</a>
                    <ul>
                      <li style="font-size:1em;">One of the most important rules of investing is diversification. If a broker concentrates your portfolio in any individual investment or type of investment, then the risk of losses with that portfolio is dramatically increased. It’s the old adage that it is unwise to place all of your "Investment” eggs in one basket. A broker Who does not diversify his client's portfolio is potentially liable if that investment declines in value.
                      </li>
                    </ul>
                  </li>    
                  <li><a href="#" style="font-size:1em;">Unauthorized Trading</a>
                    <ul>
                      <li style="font-size:1em;">Unauthorized trading is a common form of investment fraud in which a financial advisor or broker makes transactions via your nondiscretionary investment account without your explicit permission. Unauthorized trading often involves the practice of churning, in which a broker engages in an excessive level of transactions through a customer's account. This generates substantial commissions for financial advisors and brokers, but it also costs investors. Most investors maintain nondiscretionary accounts with their investment firms. In a nondiscretionary approach, your financial advisor or broker may make investment recommendations but may not make transactions linked to your investments without your consent. Other investors choose to have discretionary investment accounts, which are managed by a financial advisor or broker who is authorized in writing by the investor to make decisions regarding the purchase or sale of securities. Financial managers of discretionary accounts still have a fiduciary duty to act in the best interests of and according to the investment goals and risk tolerance of their investors.
                      </li>
                    </ul>
                  </li>

                      </li>
                    </ul>
                  </li> 

                      </li>
                    </ul>
                    </li>
    
        </ul>


<script>
(function ($, window, document, undefined) {
    if ($('ul.mtree').length) {
        var collapsed = true;
        var close_same_level = false;
        var duration = 400;
        var listAnim = true;
        var easing = 'easeOutQuart';
        $('.mtree ul').css({
            'overflow': 'hidden',
            'height': collapsed ? 0 : 'auto',
            'display': collapsed ? 'none' : 'block'
        });
        var node = $('.mtree li:has(ul)');
        node.each(function (index, val) {
            $(this).children(':first-child').css('cursor', 'pointer');
            $(this).addClass('mtree-node mtree-' + (collapsed ? 'closed' : 'open'));
            $(this).children('ul').addClass('mtree-level-' + ($(this).parentsUntil($('ul.mtree'), 'ul').length + 1));
        });
        $('.mtree li > *:first-child').on('click.mtree-active', function (e) {
            if ($(this).parent().hasClass('mtree-closed')) {
                $('.mtree-active').not($(this).parent()).removeClass('mtree-active');
                $(this).parent().addClass('mtree-active');
            } else if ($(this).parent().hasClass('mtree-open')) {
                $(this).parent().removeClass('mtree-active');
            } else {
                $('.mtree-active').not($(this).parent()).removeClass('mtree-active');
                $(this).parent().toggleClass('mtree-active');
            }
        });
        node.children(':first-child').on('click.mtree', function (e) {
            var el = $(this).parent().children('ul').first();
            var isOpen = $(this).parent().hasClass('mtree-open');
            if ((close_same_level || $('.csl').hasClass('active')) && !isOpen) {
                var close_items = $(this).closest('ul').children('.mtree-open').not($(this).parent()).children('ul');
                if ($.Velocity) {
                    close_items.velocity({ height: 0 }, {
                        duration: duration,
                        easing: easing,
                        display: 'none',
                        delay: 100,
                        complete: function () {
                            setNodeClass($(this).parent(), true);
                        }
                    });
                } else {
                    close_items.delay(100).slideToggle(duration, function () {
                        setNodeClass($(this).parent(), true);
                    });
                }
            }
            el.css({ 'height': 'auto' });
            if (!isOpen && $.Velocity && listAnim)
                el.find(' > li, li.mtree-open > ul > li').css({ 'opacity': 0 }).velocity('stop').velocity('list');
            if ($.Velocity) {
                el.velocity('stop').velocity({
                    height: isOpen ? [
                        0,
                        el.outerHeight()
                    ] : [
                        el.outerHeight(),
                        0
                    ]
                }, {
                    queue: false,
                    duration: duration,
                    easing: easing,
                    display: isOpen ? 'none' : 'block',
                    begin: setNodeClass($(this).parent(), isOpen),
                    complete: function () {
                        if (!isOpen)
                            $(this).css('height', 'auto');
                    }
                });
            } else {
                setNodeClass($(this).parent(), isOpen);
                el.slideToggle(duration);
            }
            e.preventDefault();
        });
        function setNodeClass(el, isOpen) {
            if (isOpen) {
                el.removeClass('mtree-open').addClass('mtree-closed');
            } else {
                el.removeClass('mtree-closed').addClass('mtree-open');
            }
        }
        if ($.Velocity && listAnim) {
            $.Velocity.Sequences.list = function (element, options, index, size) {
                $.Velocity.animate(element, {
                    opacity: [
                        1,
                        0
                    ],
                    translateY: [
                        0,
                        -(index + 1)
                    ]
                }, {
                    delay: index * (duration / size / 2),
                    duration: duration,
                    easing: easing
                });
            };
        }
        if ($('.mtree').css('opacity') == 0) {
            if ($.Velocity) {
                $('.mtree').css('opacity', 1).children().css('opacity', 0).velocity('list');
            } else {
                $('.mtree').show(200);
            }
        }
    }
}(jQuery, this, this.document));
$(document).ready(function () {
    var mtree = $('ul.mtree');
    mtree.wrap('<div class=mtree-demo></div>');
    var skins = [
        'bubba',
        'skinny',
        'transit',
        'jet',
        'nix'
    ];
    mtree.addClass(skins[0]);
    var s = $('.mtree-skin-selector');
    $.each(skins, function (index, val) {
        s.find('ul').append('<li><button class="small skin">' + val + '</button></li>');
    });
    s.find('ul').append('<li><button class="small csl active">Close Same Level</button></li>');
    s.find('button.skin').each(function (index) {
        $(this).on('click.mtree-skin-selector', function () {
            s.find('button.skin.active').removeClass('active');
            $(this).addClass('active');
            mtree.removeClass(skins.join(' ')).addClass(skins[index]);
        });
    });
    s.find('button:first').addClass('active');
    s.find('.csl').on('click.mtree-close-same-level', function () {
        $(this).toggleClass('active');
    });
});
</script>
            
            
            
        </div>
    </section>


    <section class="blog">
        <a name="Results" ><h2 style="padding-top: 225px; margin-top: -225px; text-align: center;">Case Results</h2></a> 
        
        
        <div class="list">
<nav role='navigation' class="list">
  <ul class="list">
    <li><a href="#" class="list"><span></span> A <h3 style="display:inline; color:black;">$5,100,000</h3> recovery for an infant in medical malpractice case who was born with an undiagnosed diaphragmatic hernia resulting in quadriparesis.</a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$4,400,000 </h3> recovery for the family in a medical malpractice case whose husband and father died as a result of an undiagnosed aortic aneurysm.</a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$3,900,000</h3> for the family in a medical malpractice case whose wife and mother died as a result of mismanagement and overdose from propafenone (marketed as Rythmol).</a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$3,300,000</h3> recovery for an infant in a medical malpractice case who suffered hypoxia  during delivery resulting in cerebral palsy.</a></li>
      <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$3,000,000</h3> recovery for a woman who required back surgery after a slip and fall accident.</a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$2,800,000</h3> recovery for a woman in a medical malpractice case whose doctors failed to diagnose and treat an abscess and infection following surgery, resulting in paraplegia. </a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$2,500,000</h3> recovery for a construction worker who fell from a scaffold rig causing wrist and ankle fractures and herniated discs. </a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$2,500,000</h3> recovery for a man in a medical malpractice whose cardiac and arterial bypass surgery led to chronic ulcerations, skin grafts and a myocardial infarction.</a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$2,400,000</h3> recovery for the family in a medical malpractice case whose husband and father died as a result of complications during bariatric surgery. </a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$2,200,000</h3> recovery for an electrical linesman who was struck by falling fiber optic reels causing severe back injuries.</a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$2,100,000</h3> recovery for the family in a medical malpractice case whose husband and father died as a result of failing to timely diagnose colon cancer. </a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$2,050, 000</h3> recovery for a construction worker who fell from an I-beam causing wrist fractures. </a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$2,000,000</h3> recovery for the family in a medical malpractice case whose husband and father died after being improperly and untimely extubated. </a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$2,000,000</h3> recovery for an infant in a medical malpractice case who suffered hypoxia during delivery resulting in cerebral palsy. </a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$1,850,000</h3> recovery for a man who was a pedestrian involved in a motor vehicle accident and sustained bilateral femur fractures and a bimalleolar ankle fracture with surgery. </a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$1,725,000</h3> recovery for a construction worker who fell from a scaffold causing spinal fractures and herniated discs. </a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$1,700,000</h3> recovery for a construction worker who fell from the Tri-borough Bridge causing a fractured ankle.</a></li>
       <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$1,600,000</h3> recovery for an ironworker who tripped and fell over a shovel and underwent multiple surgeries. </a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$1,550,000</h3> recovery for a male construction worker who fell from a scaffold and sustained severe back injuries. </a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$1,500,000</h3> recovery for an infant in a medical malpractice case whose premature birth resulted in mild spastic diparetic cerebral palsy. </a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$1,400,000</h3> recovery for two people injured in a motor vehicle accident who suffered severe neck and back injuries.</a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$1,350,000</h3> recovery for a woman in a medical malpractice case whose doctors improperly administered and monitored INH medication leading to a liver transplant. </a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$1,185,000</h3> recovery for a passenger in a motor vehicle who suffered a traumatic brain injury.</a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$1,100,000</h3> recovery for an infant in a medical malpractice case whose doctors failed to properly treat her mother’s placental abruption and failed to perform a timely c-section resulting in mild cognitive deficits. </a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$1,000,000</h3> recovery for a passenger on a motorcycle who suffered pelvic fractures.</a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$950,000</h3> recovery for a child who sustained lead poisoning in an apartment.</a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$900,000</h3> recovery for the driver of a motorcycle who suffered multiple leg fractures with surgery.</a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$875,000</h3> recovery for a construction worker who fell from a roof causing wrist and spinal fractures.</a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$850,000</h3> recovery for a man in a medical malpractice case who died as a result of his doctors’ failure to diagnose and treat a heart attack. </a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$850,000</h3> recovery for a concrete laborer was caused to be injured when he was hit with a wooden beam resulting in back surgery.</a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$825,000</h3> recovery for the family of a husband and father who died as a result of the serious injuries sustained after he was hit by a motor vehicle. </a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$800,000</h3> recovery for a construction worker who fell from a roof causing leg fractures. </a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$792,000</h3> recovery for a woman who was a passenger on a bus that was involved in a motor vehicle accident resulting in back surgery.</a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$750,000</h3> recovery for an infant in a medical malpractice case whose doctors failed to resolve shoulder dystocia leading to a moderate erb’s palsy.</a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$740,000</h3> recovery for an elderly woman in a medical malpractice case who suffered total hyphema of the globe during cataract removal surgery which lead to a loss of vision. </a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$725,000</h3> recovery for a woman involved in a motor vehicle accident resulting in laminectomy. </a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$700,000</h3> recovery for a man who was a pedestrian involved in a motor vehicle accident and sustained bilateral torn meniscus with surgery.</a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$700,000</h3> recovery for an infant in a medical malpractice case whose doctors failed to anticipate and resolve shoulder dystocia resulting in a moderate erb’s palsy in Rockland County, New York.</a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$700,000</h3> recovery for a woman in a medical malpractice case whose doctors failed to properly administer am epidural and monitor subsequent blood thinners resulting in partial paralysis. </a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$675,000</h3> recovery for a man in a medical malpractice case who sustained nerve damage after a nurse at a City Hospital improperly administered an intravenous medication. </a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$615,000</h3> recovery for a construction worker who fell on a trailer’s staircase and suffered a severe knee injury. </a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$600,000</h3> recovery for a passenger in a motor vehicle who suffered a leg fracture and hip fracture. </a></li>
    <li><a href="#" class="list"><span></span>A <h3 style="display:inline; color:black;">$500,000</h3> recovery for a child who suffered leg fractures when she was struck by a motor vehicle while crossing a street with a missing crossing-guard.</a>
    </li>
  </ul>
</nav>  
</div>

        
        
        
        
    </section>
   
    <section class="sign-up section-padding text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <a name="Contact" ><h2 style="padding-top: 225px; margin-top: -225px; text-align: center;">Contact Us!</h2></a> 
                    <h3>FREE CASE EVALUATION</h3>             
                    <p>CALL US AT : (516) 279-4800</p>
                    <p>EMAIL : HPlatz@PlatzLaw.com</p>
                    <form action="" method="post">
                        First Name: <input type="text" name="first_name"><br>
                        Last Name: <input type="text" name="last_name"><br>
                        Email: <input type="text" name="email"><br>
                        Message:<br><textarea rows="5" name="message" cols="30"></textarea><br>
                        <input type="submit" name="submit" value="Submit">
                    </form> 
                   
                </div>
                <img src="img/banner.png" style="width:60vw;">

            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                
            </div>
        </div>
    </footer>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
    <script src="bower_components/retina.js/dist/retina.js"></script>
    <script src="js/jquery.fancybox.pack.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/jquery.flexslider-min.js"></script>
    <script src="bower_components/classie/classie.js"></script>
    <script src="bower_components/jquery-waypoints/lib/jquery.waypoints.min.js"></script>
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
    function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
    e=o.createElement(i);r=o.getElementsByTagName(i)[0];
    e.src='//www.google-analytics.com/analytics.js';
    r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','UA-XXXXX-X','auto');ga('send','pageview');
    </script>
</body>
</html>