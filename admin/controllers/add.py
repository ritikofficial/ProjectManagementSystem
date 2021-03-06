#!/usr/bin/env python
import cgi
import MySQLdb
import randPass
import smtplib
import mail
import os
import commons
class user:
	uname=''
	passwd=''
	name=''
	project=''
	email=''
	def __init__(self,uname,name,project,email):
		self.uname=uname
		self.project=project
		self.email=email
		self.passwd=randPass.gen()
		self.name=name
	def writeToDatabase(self):
		con=MySQLdb.connect("localhost","root","password","GitRepo")
		cursor=con.cursor()
		query="INSERT INTO Accounts VALUES('%s','%s',SHA1('%s'),'%s','%s','%s')"\
		%(self.uname,self.name,self.passwd,self.project,self.email,' ')
		cursor.execute(query)
		con.close()
	def mail(self,login):
		if mail.send(self.uname,self.passwd,self.email,login):
			return 1
		return 0
	def mkdir(self):
		try :
			os.mkdir('/var/www/repos/'+self.project,0777)
		except OSError:
			return
		os.system('chmod 777 /var/www/repos/'+self.project)
		return
def getLogin(password):
	server=smtplib.SMTP("smtp.gmail.com:587")
	server.starttls()
	server.login('gecgitrepository@gmail.com',password)
	return server
def getdata():
	form=cgi.FieldStorage()
	i=0
	server=getLogin(form['password'].value)
	while(1):
		try:
			uname=form['uname[%d]'%(i)].value
			name=form['name[%d]'%(i)].value
			project=form['project[%d]'%(i)].value
			email=form['email[%d]'%(i)].value
		except KeyError:
			break
		userObj=user(uname,name,project,email)
		i=i+1
		if userObj.mail(server) == 0:
			con=MySQLdb.connect("localhost","root","password","GitRepo")
			cursor=con.cursor()
			cursor.execute("INSERT INTO messages VALUES('Mail to %s failed!!!')"%uname)
			con.close()
			continue
		userObj.mkdir()
		userObj.writeToDatabase()
	server.quit()
getdata()
commons.redirect('/lag/admin')
