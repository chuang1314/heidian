<?php
return array (
		//应用ID,您的APPID。
		'app_id' => "2016092500594668",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEpAIBAAKCAQEA4qfSCPGAPrU/CeTk3D4Hqhp/xvZlgV3QVpLrciOVX7EiI4uUfSS8TqDya+ZQQcEW0ME3GMe3daza5RHpq42HuxttmgsfNHOi5aLkfKOQMLcWakdrb8YP70gF/+oIIhrqxq9Xhb+tXgbFKcXBomElQnV8pCWWfQwy4tKtfzVzuEWCRKsmtwQ0kq0jIrS1cdvsTNUJOX2YCp+h27pI/YGlnoLqQGviE2baBp9Y9N21ki5o8H51BpoOaJAWsPNo3WuJalh5QF3tst+f3k5DLAmpRnphK696zf6iQecKYknwEoHcHMP+PUgyf4pkDBXB7iaKa0ED0I449hG6pbmNDHbs9QIDAQABAoIBAQC+f2Juldu92MPU4wbffVsfwwnmBa2mn1y9htpQokunk88npOb2j2udgnR976NAwLMWXW6bazBsvQ11PirxPxD3V8Q0lmhxw0cETnZPs4E7EIbMaJ6J4SP/br9sKh0P3SO6PiEHjuR9hJ8tzsJCYffY9bn+lID5NMmIDp43rotGMcCamwe9JDDqOed7YEyt22RLvLPkBpJBVrHhH+XWf1ppuEcmHmMP5/V7dt/daEpt16KrHSO+604NNu/J8IJiFKXp/Cl0Je9TtMao22XolxxnKK9LnjvvYYWyCma8VMfUAHsNbX/rVwfdVlVhtuPe3iRU5Fenznb42QISW3F/EroBAoGBAPYxuecCGA81i0DtdoLNrQhXJRIQGPG6fStdN4jt2PBPsyqO+l5nG8omHVEqRCl1B4dS33rGHZOvgPpVP9mAht7XTMOegQRAsvbAYcTRtD15fgwwVOHPY/YO0vgFaDzTos4XUh5NWsFNEjN4OAA2RA1y+VTT5l6H2laCtf69TZtBAoGBAOuu3yF/FbRlmxXkj7Ubxnn1/67g6oSu7Eja/XO+1zoFK+XPoI+zHtaQtOpoad0QwHIKouorvmMqlh6Onoq/63rQA0gFffkLiTiI5KBRVMZtkKdkWIIe6ryd75pZQj1efgRWCCwiuLbJ8ZUH7N0HYKMyQrLhhbewKogVmmZM1ii1AoGAQOb5CEJQD2phLJutW2xXSlSW7D0cJlWwe8cWRd3WC/wm0nhg3pQ2CkOkBOqsj3VPp8gcLCSgVXe1+8iPjYpJg+OkVAmsH2/i/hPXcmiKKI6nwRTYu7LNumdMDKB4S1jLmaMiPeTMoRrtSm5N7RhhNl5yBn/aQl90GsxYqDBFjkECgYEA2B+aWhsyCiWKm/7mkYwQ69JcTz/NjzLhVsYK2dNNhtUrNii58kytoNE+Nh7dxW0RLQL39ol6o3FwDEF4vX/VLuAFwkvXA0RC52cRULqEZRogJoBscZZsZ97k08O6bJB0OwGxqNeGT4jMUn/cA6w6QC1c4LDScGnJ9tToq5sWYGkCgYB5R+ValNGBr1IUKFhHDloD0KNANqI19ofG3l1Flid6tQ5DeVFZnUrCkEY5RvOu9tm4Lrbo/oCsMJDSl9GqUeX7QnLWPx8ER3uLhACV2pKvmtgxttovduEFNtZk551ube+yYgRQuVp4irLT4eZiqTX+EUJr/DRdCJYRxQXH1z2tKg==",
		
		//异步通知地址
		'notify_url' => "http://www.jewelry.com/async",
		
		//同步跳转
		'return_url' => "http://www.jewelry.com/sync",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAyYO7v4tUfnVfEbKZu7zeqFIRDwgo5hiWz36FBvYYDxaeI5YKby55ORhLUX45KfmFPy8Sjhq2UhrEO1QwNm9jYjcyrPlgoDWCIb0Pab+I+I3PAzriYJveTsOr3OKRQIdlAxqI5K/FoWXhxKF6ZER80yKbLx3E2DTpmsxRhDtpAuIiuoAaHfRpjoQTL5hqlg37AW9LTTFYz4NlRAzr01dCVihO+2WIhOFR3TL54JkXhKFKrlTD5DfnP2zENUwpz9mRCcSJM0DVqYMf7Dsqinj/RGHitNogeeAO/vEifKYVUezDhhPfCiYut3c/pC7vAre5FYCTOct9TYuLbEvfY0caLwIDAQAB",
		
	
);